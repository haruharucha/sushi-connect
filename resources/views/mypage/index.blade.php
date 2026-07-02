<x-app-layout>
    {{-- ヘッダーは非表示 --}}
    <x-slot name="header"></x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 px-4">

                {{-- ユーザー情報ヘッダー --}}
                <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                    <div>
                        <h1 class="h3 mb-1" style="color: #1f2937; font-weight: 700;">{{ $user->name }} さんのマイページ</h1>
                        <p class="text-muted mb-0">ご予約履歴の確認ができます。</p>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">
                        お店を探す
                    </a>
                </div>

                {{-- アラートメッセージ表示 --}}
                @if (session('success'))
                    <div class="alert alert-success shadow-sm mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger shadow-sm mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- 予約履歴一覧 --}}
                <h2 class="h5 mb-3 text-secondary">現在の予約・過去の履歴（全 {{ $reservations->count() }} 件）</h2>

                @if ($reservations->isEmpty())
                    <div class="card text-center p-5 shadow-sm bg-white">
                        <div class="card-body">
                            <p class="text-muted mb-3">まだ予約履歴がありません。</p>
                            <a href="{{ route('home') }}" class="btn btn-primary"
                                style="background-color: #2563eb;">お寿司屋さんを検索する</a>
                        </div>
                    </div>
                @else
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @foreach ($reservations as $reservation)
                            <div class="col">
                                <div class="card h-100 shadow-sm border-0 position-relative bg-white"
                                    style="border-radius: 0.5rem; overflow: hidden;">

                                    {{-- カードヘッダー：予約日時 --}}
                                    <div
                                        class="card-header bg-light d-flex justify-content-between align-items-center border-0 py-3">
                                        <span class="fw-bold text-primary">
                                            📅
                                            {{ \Carbon\Carbon::parse($reservation->reserved_at)->format('Y年m月d日 H:i') }}
                                        </span>

                                        {{-- 未来の予約か、過去の来店済みかでバッジを切り替える --}}
                                        @if (\Carbon\Carbon::parse($reservation->reserved_at)->isFuture())
                                            <span class="badge bg-success">予約確定</span>
                                        @else
                                            <span class="badge bg-secondary">来店済み</span>
                                        @endif
                                    </div>

                                    {{-- カードボディ：店舗情報と予約人数 --}}
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title fw-bold mb-2" style="color: #111827;">
                                            {{ $reservation->shop->name }}</h5>

                                        <p class="card-text text-muted mb-4 small">
                                            📍 {{ $reservation->shop->address ?? '店舗住所が登録されていません' }}
                                        </p>

                                        <div
                                            class="mt-auto bg-light rounded p-2 d-flex justify-content-between align-items-center">
                                            <span class="text-muted small">ご来店人数</span>
                                            <span class="fw-bold text-dark">{{ $reservation->number_of_people }}
                                                名様</span>
                                        </div>
                                    </div>

                                    <div class="card-footer bg-white border-0 pt-0 pb-3 flex-column gap-2">

                                        {{-- 標準ボタン（店舗詳細 または 口コミ） --}}
                                        <div class="d-flex gap-2 mb-2">
                                            <a href="/shops/{{ $reservation->shop_id }}"
                                                class="btn btn-outline-secondary btn-sm w-100">
                                                店舗詳細を見る
                                            </a>

                                            {{-- 来店済みの場合のみ、口コミ投稿ボタンを表示 --}}
                                            @if (\Carbon\Carbon::parse($reservation->reserved_at)->isPast())
                                                <a href="/shops/{{ $reservation->shop_id }}#review-form"
                                                    class="btn btn-primary btn-sm w-100"
                                                    style="background-color: #ef4444; border-color: #ef4444;">
                                                    口コミを書く
                                                </a>
                                            @endif
                                        </div>

                                        {{-- 未来の予約（予約確定）の場合のみ、キャンセル制御ボタンを配置 --}}
                                        @if (\Carbon\Carbon::parse($reservation->reserved_at)->isFuture())
                                            <div class="w-100">
                                                @if (\Carbon\Carbon::now()->lessThan(\Carbon\Carbon::parse($reservation->reserved_at)->copy()->subDays(2)))
                                                    {{-- 【2日前より前】キャンセル可能（フォームと赤色ボタンを表示） --}}
                                                    <form action="{{ route('reservations.destroy', $reservation) }}"
                                                        method="POST" onsubmit="return confirm('本当にこの予約をキャンセルしますか？')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm w-100"
                                                            style="background-color: #dc2626; border-color: #dc2626;">
                                                            予約をキャンセルする
                                                        </button>
                                                    </form>
                                                @else
                                                    {{-- 【2日前を過ぎた場合】グレーアウトしてネット変更不可メッセージを表示 --}}
                                                    <button type="button"
                                                        class="btn btn-sm btn-light w-100 text-muted border" disabled
                                                        style="cursor: not-allowed;">
                                                        キャンセル不可（2日前を経過）
                                                    </button>
                                                @endif
                                            </div>
                                        @endif

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <hr class="my-5">

                <h2 class="h5 mb-3 text-secondary">投稿した口コミ（全 {{ $reviews->count() }} 件）</h2>

                @if ($reviews->isEmpty())
                    <div class="card text-center p-4 shadow-sm bg-white">
                        <div class="card-body">
                            <p class="text-muted mb-0">まだ投稿した口コミはありません。</p>
                        </div>
                    </div>
                @else
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @foreach ($reviews as $review)
                            <div class="col">
                                <div class="card h-100 shadow-sm border-0 bg-white">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">{{ $review->shop->name }}</h5>

                                        <div class="text-warning mb-2">
                                            {{ str_repeat('★', $review->rating) }}
                                            <span class="text-muted small">({{ $review->rating }})</span>
                                        </div>

                                        <p class="text-muted small mb-3">
                                            {{ trim($review->comment) }}
                                        </p>

                                        <p class="text-muted small mb-0">
                                            投稿日：{{ $review->created_at->format('Y年m月d日 H:i') }}
                                        </p>
                                    </div>

                                    <div class="card-footer bg-white border-0 d-flex gap-2">
                                        <a href="{{ route('shops.show', $review->shop_id) }}"
                                            class="btn btn-outline-secondary btn-sm w-100">
                                            店舗詳細
                                        </a>

                                        <a href="{{ route('reviews.edit', $review) }}"
                                            class="btn btn-outline-primary btn-sm w-100">
                                            編集
                                        </a>

                                        <form action="{{ route('reviews.destroy', $review) }}" method="POST"
                                            class="w-100" onsubmit="return confirm('この口コミを削除しますか？');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                                削除
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
