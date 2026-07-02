<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Mail\ReservationConfirmed; // 予約完了メール
use Illuminate\Support\Facades\Mail; // メール送信用
use App\Models\Shop; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * 予約を登録する
     * 入力チェック、営業時間チェック、重複チェックを行ってから予約を保存する
     */
    public function store(Request $request)
    {
        // 入力値をチェック
        $request->validate([
            'shop_id' => 'required|exists:shops,id', // 必須入力、お店が存在するか
            'number_of_people' => 'required|integer|min:1|max:8', // 必須入力、人数は1〜8人か
            'reserved_at' => [
                'required', //必須入力
                'date',
                'after:now', // 過去の時間はNG
                
                // 予約時間が30分単位か確認
                function ($attribute, $value, $fail) {
                    $minute = date('i', strtotime($value)); // 「分」だけ取り出す
                    if ($minute !== '00' && $minute !== '30') {
                        $fail('予約時間は30分刻み（00分、または30分）で選択してください。');
                    }
                },
            ],
        ], [
            // エラーメッセージの日本語化
            'reserved_at.required' => '予約日時を選択してください。',
            'reserved_at.date'     => '正しい日時を入力してください。',
            'reserved_at.after'    => '予約日時は、現在より後の日時を指定してください。', 
            'number_of_people.required' => '人数を選択してください。',
        ]);

        // 予約日時と店舗の営業時間を比較する
        $shop = Shop::findOrFail($request->shop_id); // お店データを取得（なければ404）
        $reserveTime = Carbon::parse($request->reserved_at); // 予約希望時間

        // お店の営業時間を、予約日と同じ日付に変換して比較する
        $openingStart = Carbon::parse($reserveTime->toDateString() . ' ' . $shop->opening_start);
        $openingEnd   = Carbon::parse($reserveTime->toDateString() . ' ' . $shop->opening_end);

        // 「開店前」か「閉店後」なら、入力画面に戻してエラーを出す
        if ($reserveTime->lessThan($openingStart) || $reserveTime->greaterThan($openingEnd)) {
            return back()
                ->withInput() // 入力内容を残す
                ->withErrors(['reserved_at' => "この店舗の営業時間は {$shop->opening_start} 〜 {$shop->opening_end} です。"]);
        }

        // 同じユーザーが同じ日時に予約していないか確認
        $exists = Reservation::where('user_id', Auth::id())
                    ->where('reserved_at', $request->reserved_at)
                    ->exists(); 

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['reserved_at' => '同じ日時に既に別の予約が入っています。']);
        }

        // 予約を保存
        try {
            // データベースに予約を保存
            $reservation = Reservation::create([
                'user_id' => Auth::id(),
                'shop_id' => $request->shop_id,
                'reserved_at' => $request->reserved_at,
                'number_of_people' => $request->number_of_people,
            ]);

            // 予約完了メールを送信
           // $userEmail = Auth::user()->email; 
           // Mail::to($userEmail)->send(new ReservationConfirmed($reservation));

            // 完了画面へリダイレクト
            return redirect()->route('reservations.done')
                             ->with('success', '予約が完了しました！');

        } catch (\Exception $e) {
            // 予約保存またはメール送信に失敗した場合
            return back()
                ->withInput()
                ->withErrors(['error' => 'システムエラーが発生しました。時間を置いて再度お試しください。']);
        }
    }

    /**
     * 予約をキャンセルする
     * 本人の予約か確認し、キャンセル期限内であれば削除する
     */
    public function destroy(Reservation $reservation)
    {
        // 他人の予約はキャンセルできないようにする
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('mypage.index')
                ->with('error', '不正なアクセスです。');
        }

        // 予約日の2日前を過ぎていないか確認
        $reservationDate = Carbon::parse($reservation->reserved_at); // 予約した日時
        $now = Carbon::now();                                        // 今

        // キャンセル期限を過ぎている場合は削除しない
        if ($now->greaterThanOrEqualTo($reservationDate->copy()->subDays(2))) {
            return redirect()->back()
                ->with('error', 'ご予約の2日前を過ぎているため、サイト上からのキャンセルはできません。お電話にてお問い合わせください。');
        }

        // 予約を削除
        $reservation->delete();

        // マイページに戻して成功メッセージを伝える
        return redirect()->route('mypage.index')
            ->with('success', 'ご予約をキャンセルしました。');
    }
}