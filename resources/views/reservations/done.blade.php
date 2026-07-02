<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約完了 | すしコネクト</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-between">

    {{-- ==========================================
         ヘッダー部分（トップの一覧画面とデザインを統一）
         ========================================== --}}
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                予約完了
            </h2>
            <a href="{{ url('/') }}" class="text-sm bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded transition">
                ← トップページへ戻る
            </a>
        </div>
    </header>

    {{-- ==========================================
         メインコンテンツ（画面中央のメッセージカード）
         ========================================== --}}
    <main class="flex-grow flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full bg-white shadow-sm rounded-lg p-8 text-center border border-gray-200">
            
            {{-- 予約完了メッセージ --}}
            <h1 class="text-2xl font-bold text-gray-900 mb-3">ご予約ありがとうございます！</h1>
            <p class="text-gray-600 mb-6 text-sm leading-relaxed">
                お店への予約が正常に完了いたしました。<br>
                ご来店を心よりお待ちしております。
            </p>

            {{-- 成功メッセージ --}}
            @if (session('success'))
                <div class="mb-6">
                    <span class="inline-block text-sm text-green-700 bg-green-50 border border-green-200 px-4 py-2 rounded-md font-semibold">
                        {{ session('success') }}
                    </span>
                </div>
            @endif

            {{--  戻るボタン --}}
            <div class="space-y-3">
                <a href="{{ url('/') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-150 shadow-sm text-center">
                    トップページ（お店一覧）へ戻る
                </a>
                
                {{-- マイページへ移動 --}}
                <a href="{{ route('mypage.index') }}" class="block w-full bg-white hover:bg-gray-50 text-gray-700 font-semibold py-3 px-4 rounded-lg border border-gray-300 transition duration-150 text-center shadow-sm">
                    予約状況を確認する（マイページ）
                </a>
            </div>
        </div>
    </main>

    {{-- ==========================================
         フッター部分（すしコネクトの共通フッター）
         ========================================== --}}
    <footer class="bg-gray-800 text-white text-center py-4 text-sm mt-auto">
        &copy; 2026 すしコネクト. All Rights Reserved.
    </footer>

</body>
</html>