<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $shop->name }} の店舗詳細</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    {{-- ==========================================
         ヘッダー部分
         ========================================== --}}
    <header class="bg-white shadow">
        <div
            class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $shop->name }} の店舗詳細
            </h2>

            {{-- ボタンエリア（右側） --}}
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('mypage.index') }}"
                        class="text-sm font-bold text-white/80 hover:text-white flex items-center gap-1 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        マイページ
                    </a>
                @endauth

                <a href="{{ route('home') }}"
                    class="text-sm bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded transition">
                    ← トップページへ戻る
                </a>
            </div>
        </div>
    </header>

    {{-- ==========================================
         メインコンテンツ部分
         ========================================== --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- 【左側エリア：お店の詳細情報 ＆ 口コミ】 --}}
                <div class="md:col-span-2 space-y-6">

                    {{-- お店情報カード --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        @if ($shop->image_path)
                            <img src="{{ asset('images/shops/' . $shop->image_path) }}" alt="{{ $shop->name }}"
                                class="w-full h-56 md:h-96 object-cover rounded-lg mb-6 shadow-sm hover:scale-[1.01] transition">
                        @else
                            <div
                                class="w-full h-56 md:h-80 bg-gray-200 rounded-lg mb-6 flex items-center justify-center text-gray-400">
                                No Image
                            </div>
                        @endif

                        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $shop->name }}</h1>

                        <div class="mb-6 bg-amber-50/60 border-l-4 border-red-500 p-4 rounded-r-lg">
                            <h3 class="text-sm font-bold text-red-800 mb-1">📢 おみせの紹介</h3>
                            <p class="text-gray-700 text-base leading-relaxed whitespace-pre-line text-left">
                                {{ $shop->description ?? '（お店からの紹介文はまだありません）' }}</p>
                        </div>

                        <div class="border-t border-gray-200 pt-6 space-y-4 text-base text-gray-700">
                            <p class="flex items-center">
                                <span class="font-bold w-24 text-gray-500">📮 郵便番号:</span>
                                <span
                                    class="bg-gray-100 px-2 py-1 rounded text-sm font-mono">〒{{ $shop->postal_code }}</span>
                            </p>
                            <p class="flex items-center">
                                <span class="font-bold w-24 text-gray-500">🗾 エリア:</span>
                                <span
                                    class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm font-semibold">{{ $shop->area }}</span>
                            </p>
                            <p class="flex items-center">
                                <span class="font-bold w-24 text-gray-500">📍 住所:</span>
                                <span>
                                    <a href="http://maps.google.com/?q={{ urlencode($shop->address) }}" target="_blank"
                                        class="text-blue-600 underline hover:text-blue-800">
                                        {{ $shop->address }}
                                    </a>
                                </span>
                            </p>
                            <p class="flex items-center">
                                <span class="font-bold w-24 text-gray-500">📞 電話番号:</span>
                                <a href="tel:{{ $shop->phone_number }}"
                                    class="text-blue-600 underline hover:text-blue-800">{{ $shop->phone_number }}</a>
                            </p>
                            <p class="flex items-center">
                                <span class="font-bold w-24 text-gray-500">🍣 スタイル:</span>
                                <span
                                    class="bg-gray-100 border border-gray-300 text-gray-800 px-2.5 py-0.5 rounded-full text-sm font-medium">
                                    {{ $shop->style ?? '未設定' }}
                                </span>
                            </p>
                            <p class="flex items-center">
                                <span class="font-bold w-24 text-gray-500">💰 予算目安:</span>
                                <span class="font-semibold text-gray-900">{{ $shop->price_range ?? '未設定' }}</span>
                            </p>
                            <p class="flex items-center">
                                <span class="font-bold w-24 text-gray-500">⏰ 営業時間:</span>
                                <span class="font-semibold">
                                    {{ \Carbon\Carbon::parse($shop->opening_start)->format('H:i') }} 〜
                                    {{ \Carbon\Carbon::parse($shop->opening_end)->format('H:i') }}
                                </span>
                            </p>
                        </div>
                    </div>

                    {{-- 口コミエリア --}}
                    <div class="space-y-6">
                        @if (session('success'))
                            <div
                                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg text-sm shadow-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        @auth
                            <div class="bg-white shadow-sm sm:rounded-lg p-6 border border-gray-100">
                                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                    <span class="mr-2">✍️</span> このお店の口コミを書く
                                </h3>

                                <form action="{{ route('reviews.store', $shop->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="rating"
                                            class="block text-gray-700 font-semibold mb-1 text-sm">満足度（5段階）</label>
                                        <select name="rating" id="rating"
                                            class="w-32 border-gray-300 rounded-md shadow-sm p-2 border focus:ring focus:ring-red-200 focus:border-red-500 text-amber-500 font-bold">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <option value="{{ $i }}"
                                                    {{ old('rating', '3') == $i ? 'selected' : '' }}>
                                                    {{ str_repeat('⭐', $i) }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div>
                                        <label for="comment"
                                            class="block text-gray-700 font-semibold mb-1 text-sm">コメント</label>
                                        <textarea name="comment" id="comment" rows="4" placeholder="お店の感想やおすすめのネタなど、素敵な思い出をシェアしてください（400文字まで）"
                                            class="w-full border-gray-300 rounded-md shadow-sm p-3 border focus:ring focus:ring-red-200 focus:border-red-500 text-sm text-gray-700">{{ old('comment') }}</textarea>
                                        @error('comment')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="bg-red-500 text-white font-bold py-2 px-6 rounded-lg hover:bg-red-600 transition duration-150 shadow-sm text-sm">
                                            口コミを投稿する
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center text-sm text-gray-500">
                                🔒 口コミを投稿するには、<a href="{{ route('login') }}?redirect_to={{ urlencode(url()->current()) }}"
                                    class="text-blue-600 underline hover:text-blue-800">ログイン</a> が必要です。
                            </div>
                        @endauth

                        <div class="bg-white shadow-sm sm:rounded-lg p-6 border border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <span class="mr-2">💬</span> みんなの口コミ（{{ $shop->reviews->count() }}件）
                            </h3>

                            @if ($shop->reviews->isNotEmpty())
                                <div class="space-y-4 divide-y divide-gray-100">
                                    @foreach ($shop->reviews as $review)
                                        <div class="pt-4 first:pt-0 w-full">
                                            <div class="flex justify-between items-start mb-2">
                                                <div>
                                                    <span class="font-bold text-gray-800 text-sm">👤
                                                        {{ $review->user->name }} さん</span>
                                                    <div class="text-amber-400 font-bold text-sm mt-0.5">
                                                        {{ str_repeat('⭐', $review->rating) }}
                                                        <span
                                                            class="text-gray-400 text-xs font-normal">({{ $review->rating }})</span>
                                                    </div>
                                                </div>
                                                <span
                                                    class="text-xs text-gray-400 font-mono">{{ $review->created_at->format('Y/m/d H:i') }}</span>
                                            </div>
                                            <p
                                                class="block w-full text-left text-gray-700 text-sm leading-relaxed pl-1">
                                                {{ trim($review->comment) }}</p>

                                            @if (Auth::check() && Auth::id() === $review->user_id)
                                                <div class="flex justify-end items-center gap-3 mt-3">
                                                    <a href="{{ route('reviews.edit', $review) }}"
                                                        class="text-blue-600 text-sm hover:underline">
                                                        ✏️ 編集
                                                    </a>

                                                    <form action="{{ route('reviews.destroy', $review) }}"
                                                        method="POST" onsubmit="return confirm('この口コミを削除しますか？');">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                            class="text-red-600 text-sm hover:underline">
                                                            🗑️ 削除
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 text-gray-400 text-sm">
                                    まだこのお店への口コミはありません。<br>最初の口コミを投稿してみませんか？
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                {{-- ==========================================
                     【右側エリア：予約フォーム】
                     ========================================== --}}
                <div class="md:col-span-1">
                    <div class="sticky top-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 px-6">ここで予約する</h3>

                        @auth
                            <form action="{{ route('reservations.store') }}" method="POST"
                                class="p-6 bg-white rounded-lg shadow-md border border-gray-100">
                                @csrf
                                <input type="hidden" name="shop_id" value="{{ $shop->id }}">

                                {{-- 📅 予約日時 --}}
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-2 text-sm">予約日時</label>

                                    <div class="flex gap-2">
                                        {{-- 日付選択（min属性で過去日を選択不可に） --}}
                                        <input type="date" name="reserve_date" id="reserve_date"
                                            value="{{ old('reserve_date') }}" min="{{ date('Y-m-d') }}"
                                            class="w-1/2 border-gray-300 rounded-md shadow-sm p-2 border focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm">

                                        {{-- 🕒 営業時間連動プルダウン --}}
                                        <select name="reserve_time" id="reserve_time"
                                            class="w-1/2 border-gray-300 rounded-md shadow-sm p-2 border focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm">
                                            @php
                                                $start = \Carbon\Carbon::parse($shop->opening_start);
                                                $end = \Carbon\Carbon::parse($shop->opening_end);
                                            @endphp

                                            @while ($start->lessThan($end))
                                                @php $timeStr = $start->format('H:i'); @endphp
                                                <option value="{{ $timeStr }}"
                                                    {{ old('reserve_time') == $timeStr ? 'selected' : '' }}>
                                                    {{ $timeStr }}
                                                </option>
                                                @php $start->addMinutes(30); @endphp
                                            @endwhile
                                        </select>
                                    </div>

                                    {{-- 隠しフィールド --}}
                                    <input type="hidden" name="reserved_at" id="reserved_at"
                                        value="{{ old('reserved_at') }}">

                                    {{-- バリデーションエラー表示 --}}
                                    @error('reserve_date')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    @error('reserve_time')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    @error('reserved_at')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- 👥 人数選択 --}}
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-2 text-sm">人数</label>
                                    <select name="number_of_people" id="number_of_people"
                                        class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm">
                                        @for ($i = 1; $i <= 8; $i++)
                                            <option value="{{ $i }}"
                                                {{ old('number_of_people') == $i ? 'selected' : '' }}>{{ $i }}名
                                            </option>
                                        @endfor
                                    </select>
                                    @error('number_of_people')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- 🚨 エラー表示 --}}
                                @error('error')
                                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <button type="submit"
                                    class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-150 shadow-sm text-sm">
                                    予約を確定する
                                </button>
                            </form>
                        @else
                            <div class="p-6 bg-gray-50 rounded-lg shadow-md border border-gray-200 text-center">
                                <p class="text-gray-500 text-sm mb-4">🔒 予約機能を利用するには<br>ログインが必要です。</p>
                                <a href="{{ route('login') }}?redirect_to={{ urlencode(url()->current()) }}"
                                    class="inline-block w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition text-sm">
                                    ログイン画面へ
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ==========================================
         JavaScript部分
         ========================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('reserve_date');
            const timeInput = document.getElementById('reserve_time');
            const hiddenInput = document.getElementById('reserved_at');

            // ログインしていない場合は要素が存在しないためガード
            if (!dateInput || !timeInput || !hiddenInput) return;

            function updateReservedAt() {
                if (dateInput.value && timeInput.value) {
                    hiddenInput.value = `${dateInput.value} ${timeInput.value}:00`;
                } else {
                    hiddenInput.value = '';
                }
            }

            dateInput.addEventListener('change', updateReservedAt);
            timeInput.addEventListener('change', updateReservedAt);

            // 初回読み込み時の同期（オールドデータ復元用）
            updateReservedAt();
        });
    </script>

</body>

</html>
