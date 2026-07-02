<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop; 
use App\Models\Review;


class AdminController extends Controller
{
    /**
     * 管理者用ダッシュボード（トップ画面）を表示する
     */
    public function index()
    {
        $shops = Shop::all();

        $reviews = Review::with(['shop', 'user'])
            ->latest()
            ->get();

        return view('admin.dashboard', compact('shops', 'reviews'));
    }    
    /**
     * 店舗の新規登録画面（入力フォーム）を表示する
     */
    public function create()
    {
        return view('admin.shops.create');
    }

    /**
     * 届いたデータをバリデーションしてデータベースに新規保存する
     */
    public function store(Request $request)
    {
        // 入力値をチェック
        $request->validate([
            'name'          => 'required|string|max:255',
            'postal_code'   => 'required|string|max:10',
            'area'          => 'required|string|max:50',
            'style'         => 'required|string|max:50',       
            'price_range'   => 'required|string|max:50',      
            'description'   => 'required|string|max:1000',     
            'address'       => 'required|string|max:255',
            'phone_number'  => 'required|string|max:20',
            'opening_start' => 'required',
            'opening_end'   => 'required',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 画像は任意（2MBまで）
        ]);

        // 新しい店舗データを作成
        $shop = new Shop();

        // 入力内容を店舗データに設定
        $shop->name = $request->input('name');
        $shop->postal_code = $request->input('postal_code');
        $shop->area = $request->input('area');
        $shop->style = $request->input('style');                
        $shop->price_range = $request->input('price_range');     
        $shop->description = $request->input('description');     
        $shop->address = $request->input('address');
        $shop->phone_number = $request->input('phone_number');
        $shop->opening_start = $request->input('opening_start');
        $shop->opening_end = $request->input('opening_end');

        // 画像がアップロードされた場合は保存
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/shops', $fileName);
            $shop->image_path = $fileName;
        }       

        // 店舗データを保存
        $shop->save();

        return redirect()->route('admin.dashboard')->with('success', '新しいお寿司屋さんを登録しました！');
    }

    /**
     * 編集画面を表示する
     */
    public function edit($id)
    {
        // 編集する店舗を取得
        $shop = Shop::findOrFail($id);
        return view('admin.shops.edit', compact('shop'));
    }

    /**
     * 書き換えられたデータをバリデーションして上書き保存する
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'postal_code'   => 'required|string|max:10',
            'area'          => 'required|string|max:50',
            'style'         => 'required|string|max:50',       
            'price_range'   => 'required|string|max:50',       
            'description'   => 'required|string|max:1000',     
            'address'       => 'required|string|max:255',
            'phone_number'  => 'required|string|max:20',
            'opening_start' => 'required',
            'opening_end'   => 'required',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $shop = Shop::findOrFail($id);

        // 入力内容で店舗データを更新
        $shop->name = $request->input('name');
        $shop->postal_code = $request->input('postal_code');
        $shop->area = $request->input('area');
        $shop->style = $request->input('style');                
        $shop->price_range = $request->input('price_range');    
        $shop->description = $request->input('description');     
        $shop->address = $request->input('address');
        $shop->phone_number = $request->input('phone_number');
        $shop->opening_start = $request->input('opening_start');
        $shop->opening_end = $request->input('opening_end');
        
        // 新しい画像がアップロードされた場合は保存
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/shops', $fileName);
            $shop->image_path = $fileName;
        }

        // 店舗データを更新
        $shop->save();

        return redirect()->route('admin.dashboard')->with('success', '店舗情報を更新しました！');
    }

    /**
     * 店舗を削除する
     */
    public function destroy($id)
    {
        // 削除する店舗を取得
        $shop = Shop::findOrFail($id);
        // 店舗を削除
        $shop->delete();
        return redirect()->route('admin.dashboard')->with('success', '店舗を削除しました！');
    }

    /**
     * 口コミを削除する
     */

    public function destroyReview(Review $review)
    {
        $review->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', '口コミを削除しました！');
    }
}