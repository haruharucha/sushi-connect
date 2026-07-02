<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>口コミを編集</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-2xl mx-auto py-10">

    <div class="bg-white rounded-lg shadow p-6">

        <h1 class="text-2xl font-bold mb-6">
            ✏️ 口コミを編集
        </h1>

        <form action="{{ route('reviews.update', $review->id) }}" method="POST">
            @csrf
            @method('PATCH')

            {{-- 星評価 --}}
            <div class="mb-5">
                <label class="block font-bold mb-2">
                    満足度
                </label>

                <select name="rating"
                    class="border rounded p-2 w-32">
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}"
                            {{ old('rating', $review->rating) == $i ? 'selected' : '' }}>
                            {{ str_repeat('⭐', $i) }}
                        </option>
                    @endfor
                </select>
            </div>

            {{-- コメント --}}
            <div class="mb-5">
                <label class="block font-bold mb-2">
                    コメント
                </label>

                <textarea
                    name="comment"
                    rows="5"
                    class="w-full border rounded p-3">{{ old('comment', $review->comment) }}</textarea>
            </div>

            <div class="flex justify-end gap-3">

                <a href="{{ route('shops.show', $review->shop_id) }}"
                    class="bg-gray-500 text-white px-5 py-2 rounded hover:bg-gray-600">
                    キャンセル
                </a>

                <button
                    class="bg-red-500 text-white px-5 py-2 rounded hover:bg-red-600">
                    更新する
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>