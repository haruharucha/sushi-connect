<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>すしコネクト：管理者ダッシュボード</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="#">🍣 すしコネクト 管理画面</a>
            <div class="navbar-nav ms-auto align-items-center">
                <span class="nav-link text-white-50">👑 管理者としてログイン中</span>

                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link text-white border-0 bg-transparent">
                        <i class="bi bi-box-arrow-right"></i> ログアウト
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5 bg-white rounded">
                        <h2 class="card-title text-danger fw-bold mb-4">👑 管理者ダッシュボード</h2>
                        <p class="card-text fs-5 text-secondary">
                            ここでは、お寿司屋さんの新規登録・編集や、投稿された口コミの確認を行うことができます。
                        </p>

                        <hr class="my-4">

                        {{-- 🍣 店舗新規登録ボタン --}}
                        <div class="mb-4 text-end">
                            <a href="{{ route('admin.shops.create') }}" class="btn btn-danger btn-lg shadow-sm">
                                <i class="bi bi-plus-circle"></i> 新しい店舗を登録する
                            </a>
                        </div>

                        {{-- 登録店舗一覧 --}}
                        <div class="card shadow-sm border-0 mt-4">
                            <div class="card-body p-4 bg-white rounded">
                                <h3 class="h5 fw-bold text-dark mb-4">
                                    <i class="bi bi-list-ul text-danger"></i> 登録店舗一覧
                                </h3>

                                @if ($shops->isEmpty())
                                    <p class="text-secondary text-center my-4">登録されている店舗がありません。新しい店舗を追加してください。</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th style="width: 8%">ID</th>
                                                    <th style="width: 12%">画像</th>
                                                    <th style="width: 20%">店舗名</th>
                                                    <th style="width: 12%">郵便番号</th>
                                                    <th style="width: 10%">エリア</th>
                                                    <th style="width: 18%">住所</th>
                                                    <th style="width: 15%">営業時間</th>
                                                    <th style="width: 15%">操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($shops as $shop)
                                                    <tr>
                                                        <td class="fw-bold text-secondary">#{{ $shop->id }}</td>

                                                        <td>
                                                            @if ($shop->image_path)
                                                                {{-- 店舗画像を表示 --}}
                                                                <img src="{{ asset('images/shops/' . $shop->image_path) }}"
                                                                    alt="{{ $shop->name }}" class="img-thumbnail"
                                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                                            @else
                                                                {{-- 画像がない場合 --}}
                                                                <div class="bg-light text-center rounded border d-flex align-items-center justify-content-center"
                                                                    style="width: 60px; height: 60px;">
                                                                    <i class="bi bi-image text-muted"
                                                                        style="font-size: 1.5rem;"></i>
                                                                </div>
                                                            @endif
                                                        </td>

                                                        <td class="fw-bold text-dark">{{ $shop->name }}</td>
                                                        <td>
                                                            <span
                                                                class="badge bg-light text-dark border">{{ $shop->postal_code }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-success">{{ $shop->area }}</span>
                                                        </td>

                                                        <td class="text-secondary">{{ $shop->address }}</td>
                                                        <td>
                                                            @if ($shop->opening_start && $shop->opening_end)
                                                                <small class="text-muted">
                                                                    <i class="bi bi-clock"></i>
                                                                    {{ \Carbon\Carbon::parse($shop->opening_start)->format('H:i') }}
                                                                    ～
                                                                    {{ \Carbon\Carbon::parse($shop->opening_end)->format('H:i') }}
                                                                </small>
                                                            @else
                                                                <span class="text-muted-50">--:--</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <a href="{{ route('admin.shops.edit', $shop->id) }}"
                                                                    class="btn btn-sm btn-outline-primary">
                                                                    <i class="bi bi-pencil-square"></i> 編集
                                                                </a>

                                                                <form
                                                                    action="{{ route('admin.shops.destroy', $shop->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('本当にこの店舗を削除してもよろしいですか？');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-outline-danger">
                                                                        <i class="bi bi-trash"></i> 削除
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                            </div>
                        </div>
                        {{-- 💬 投稿された口コミ一覧 --}}
                        <div class="card shadow-sm border-0 mt-4">
                            <div class="card-body p-4 bg-white rounded">
                                <h3 class="h5 fw-bold text-dark mb-4">
                                    <i class="bi bi-chat-dots text-danger"></i> 投稿された口コミ一覧
                                </h3>

                                @if ($reviews->isEmpty())
                                    <p class="text-secondary text-center my-4">投稿された口コミはありません。</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>店舗名</th>
                                                    <th>投稿者</th>
                                                    <th>評価</th>
                                                    <th>コメント</th>
                                                    <th>投稿日</th>
                                                    <th>操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($reviews as $review)
                                                    <tr>
                                                        <td class="fw-bold">{{ $review->shop->name }}</td>
                                                        <td>{{ $review->user->name }}</td>
                                                        <td class="text-warning">{{ str_repeat('★', $review->rating) }}
                                                        </td>
                                                        <td class="text-secondary">{{ $review->comment }}</td>
                                                        <td>
                                                            <small class="text-muted">
                                                                {{ $review->created_at->format('Y/m/d H:i') }}
                                                            </small>
                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('admin.reviews.destroy', $review) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('この口コミを削除しますか？');">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger text-nowrap">
                                                                    <i class="bi bi-trash"></i> 削除
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
