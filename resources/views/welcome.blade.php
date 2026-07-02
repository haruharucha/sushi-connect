<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🍣 すしコネクト - 街のお寿司屋さん reserve アプリ</title>
    <link rel="preload" as="image" href="{{ asset('images/header.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">🍣 すしコネクト</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2 mt-2 mt-lg-0">

                    {{-- ─── ログインしていない時（ゲスト） ─── --}}
                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-white-50 px-2 fw-bold" style="transition: color 0.2s;"
                                onmouseover="this.style.color='#ffffff'"
                                onmouseout="this.style.color='rgba(255,255,255,0.5)'" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> ログイン
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-sm btn-light fw-bold px-3 shadow-sm text-danger"
                                style="height: 31px; line-height: 1.4;" href="{{ route('register') }}">
                                会員登録
                            </a>
                        </li>
                    @endguest

                    {{-- ─── ログインしている時（認証済み） ─── --}}
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white-50 px-2 fw-bold" style="transition: color 0.2s;"
                                onmouseover="this.style.color='#ffffff'"
                                onmouseout="this.style.color='rgba(255,255,255,0.5)'" href="{{ route('mypage.index') }}">
                                <i class="bi bi-person-circle"></i> マイページ
                            </a>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit"
                                    class="nav-link text-white-50 border-0 text-decoration-none px-2 fw-bold"
                                    style="background: transparent; transition: color 0.2s;"
                                    onmouseover="this.style.color='#ffffff'"
                                    onmouseout="this.style.color='rgba(255,255,255,0.5)'">
                                    <i class="bi bi-box-arrow-right"></i> ログアウト
                                </button>
                            </form>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    <header class="text-white text-center py-4 py-md-5 mb-4"
        style="
        background-color: #B22222;
        background-image:
            linear-gradient(rgba(0,0,0,0.35), rgba(0,0,0,0.35)),
            url('{{ asset('images/header.jpg') }}');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    ">
        <div class="container py-3 py-md-4">
            <h1 class="fw-bold display-5 hero-title">美味しいお寿司と、<br class="d-block d-md-none">
                あなたを繋ぐ。</h1>
            <p class="lead fw-bold text-white hero-subtitle" style="opacity: 0.85;">
                「すしコネクト」は、地元の素敵なお寿司屋さんを簡単に探して予約できるサービスです。</p>
        </div>
    </header>

    <main class="container mb-5">

        {{-- ==========================================
             ✨ 今月の旬魚表示エリア ✨
             ========================================== --}}
        <div class="row justify-content-center mb-3">
            <div class="col-md-10">
                <div class="p-3 bg-white rounded-3 shadow-sm border-start border-danger border-4">
                    <div class="d-flex flex-column flex-md-row align-items-md-center gap-2">
                        <div class="fw-bold text-dark flex-shrink-0">
                            <i class="bi bi-calendar3 text-danger me-1"></i>
                            {{ $currentMonth }}月の旬魚：
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($seasonalFishes as $fish)
                                {{-- 魚名をキーワードにして検索  --}}
                                <a href="{{ route('home', ['keyword' => $fish->name]) }}" class="text-decoration-none">
                                    <span
                                        class="badge bg-light text-danger border border-danger-subtle px-3 py-2 rounded-pill shadow-sm"
                                        style="cursor: pointer;">
                                        🍣 {{ $fish->name }}
                                    </span>
                                </a>
                            @empty
                                <span class="text-muted small py-1">ただいま今月の旬魚データを準備中です。</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ==========================================
             お寿司屋さん検索窓エリア
             ========================================== --}}
        <div class="row justify-content-center mb-5">
            <div class="col-md-10">
                <div class="card shadow-sm border-0 p-4 bg-white rounded-3">
                    <form action="{{ route('home') }}" method="GET" class="row g-3 align-items-center">

                        {{-- 🗺️ エリア（都道府県）選択 --}}
                        <div class="col-md-4">
                            <label class="form-label small text-secondary"><i class="bi bi-geo-alt text-danger"></i>
                                エリア</label>
                            <select name="area" class="form-select">
                                <option value="">すべてのエリア</option>
                                <option value="静岡県" {{ request('area') == '静岡県' ? 'selected' : '' }}>静岡県</option>
                                <option value="東京都" {{ request('area') == '東京都' ? 'selected' : '' }}>東京都</option>
                                <option value="大阪府" {{ request('area') == '大阪府' ? 'selected' : '' }}>大阪府</option>
                            </select>
                        </div>

                        {{-- 🔍 キーワード入力（店名・ネタ名など） --}}
                        <div class="col-md-5">
                            <label class="form-label small text-secondary"><i class="bi bi-search text-danger"></i>
                                キーワード</label>
                            <input type="text" name="keyword" class="form-control" placeholder="店名、ネタ（マグロ等）、特徴など"
                                value="{{ request('keyword') }}">
                        </div>

                        {{-- 🚀 検索ボタン --}}
                        <div class="col-md-3 d-grid align-self-end">
                            <button type="submit" class="btn btn-danger fw-bold shadow-sm py-2">
                                <i class="bi bi-search"></i> お店を探す
                            </button>
                        </div>

                        {{-- 🔄 検索クリアボタン（検索中のみ表示） --}}
                        @if (request('area') || request('keyword'))
                            <div class="col-12 text-end mt-2">
                                <a href="{{ route('home') }}" class="text-secondary small text-decoration-none">
                                    <i class="bi bi-x-circle"></i> 検索条件をクリア
                                </a>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>

        {{-- ==========================================
             店舗一覧表示エリア
             ========================================== --}}
        <h2 class="fw-bold mb-4 text-dark text-center">
            <i class="bi bi-shop text-danger"></i>
            @if (request('area') || request('keyword'))
                検索結果一覧（{{ $shops->count() }}件）
            @else
                登録店舗一覧
            @endif
        </h2>

        <div class="row g-4">
            @forelse($shops as $shop)
                <div class="col-12 col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if ($shop->image_path)
                            <img src="{{ asset('images/shops/' . $shop->image_path) }}" class="card-img-top"
                                alt="{{ $shop->name }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-secondary text-white d-flex flex-column align-items-center justify-content-center"
                                style="height: 200px;">
                                <i class="bi bi-image mb-2" style="font-size: 3rem;"></i>
                                <span class="fw-bold">No Image</span>
                            </div>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark">{{ $shop->name }}</h5>

                            <p class="card-text text-secondary small mb-2">
                                <i class="bi bi-geo-alt-fill text-danger"></i>
                                〒{{ $shop->postal_code }}
                                {{ $shop->address }}
                            </p>

                            <p class="card-text text-secondary small mb-3">
                                <i class="bi bi-clock-fill text-muted"></i>
                                営業時間:
                                @if ($shop->opening_start && $shop->opening_end)
                                    {{ \Carbon\Carbon::parse($shop->opening_start)->format('H:i') }}
                                    ～
                                    {{ \Carbon\Carbon::parse($shop->opening_end)->format('H:i') }}
                                @else
                                    情報なし
                                @endif
                            </p>
                        </div>

                        <div class="card-footer bg-white border-0 p-3 pt-0">
                            <a href="{{ route('shops.show', $shop->id) }}" class="btn btn-danger w-100 shadow-sm">
                                <i class="bi bi-calendar-check"></i>
                                このお店を予約する
                            </a>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12 d-flex justify-content-center">
                    <div class="text-center my-5">
                        <i class="bi bi-exclamation-triangle text-warning fs-1 d-block mb-3"></i>

                        <p class="text-secondary fs-5 mb-3">
                            該当するお寿司屋さんが見つかりませんでした。
                        </p>

                        <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">
                            トップへ戻る
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-dark text-white-50 text-center py-4 mt-auto">
        <p class="mb-0">&copy; 2026 すしコネクト. All Rights Reserved.</p>
    </footer>
    <style>
        /* スマホ用 */
        @media (max-width: 576px) {

            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 0.9rem;
                font-weight: 400 !important;
                opacity: 0.8;
                margin-top: 1.8rem;
            }

        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
