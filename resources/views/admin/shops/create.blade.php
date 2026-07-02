<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規店舗登録 - すしコネクト管理画面</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="{{ route('admin.dashboard') }}">🍣 すしコネクト 管理画面</a>
            <div class="navbar-nav ms-auto">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-light">
                    <i class="bi bi-arrow-left-circle"></i> ダッシュボードに戻る
                </a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5 bg-white rounded">
                        
                        <h2 class="card-title text-danger fw-bold mb-4">
                            <i class="bi bi-shop"></i> 新しい店舗を登録する
                        </h2>
                        <p class="text-secondary mb-4">お寿司屋さんの基本情報を入力してください。</p>
                        
                        {{-- 🛡️ バリデーションエラーのまとめ表示アラート --}}
                        @if ($errors->any())
                            <div class="alert alert-danger shadow-sm border-0 mb-4">
                                <div class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill"></i> 入力内容にエラーがあります</div>
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <hr class="my-4">

                        <form action="{{ route('admin.shops.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- 店舗名 --}}
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">店舗名 <span class="badge bg-danger">必須</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="例：すし処 すしコネクト" value="{{ old('name') }}" required>
                            </div>

                            {{-- 郵便番号 --}}
                            <div class="mb-3">
                                <label for="postal_code" class="form-label fw-bold">郵便番号 <span class="badge bg-danger">必須</span></label>
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" placeholder="例：123-4567" value="{{ old('postal_code') }}" required>
                            </div>

                            {{-- エリア（都道府県） --}}
                            <div class="mb-3">
                                <label for="area" class="form-label fw-bold">エリア（都道府県）<span class="badge bg-danger">必須</span></label>
                                <select class="form-select @error('area') is-invalid @enderror" id="area" name="area" required>
                                    <option value="">選択してください</option>
                                    <option value="静岡県" {{ old('area') == '静岡県' ? 'selected' : '' }}>静岡県</option>
                                    <option value="東京都" {{ old('area') == '東京都' ? 'selected' : '' }}>東京都</option>
                                    <option value="大阪府" {{ old('area') == '大阪府' ? 'selected' : '' }}>大阪府</option>
                                </select>
                            </div>

                            {{-- 住所 --}}
                            <div class="mb-3">
                                <label for="address" class="form-label fw-bold">住所 <span class="badge bg-danger">必須</span></label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="例：静岡県藤枝市◯◯ 1-2-3" value="{{ old('address') }}" required>
                            </div>

                            {{-- 電話番号 --}}
                            <div class="mb-3">
                                <label for="phone_number" class="form-label fw-bold">電話番号 <span class="badge bg-danger">必須</span></label>
                                <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" placeholder="例：090-1234-5678" value="{{ old('phone_number') }}" required>
                            </div>

                            {{--  お寿司のスタイル選択  --}}
                            <div class="mb-3">
                                <label for="style" class="form-label fw-bold">スタイル <span class="badge bg-danger">必須</span></label>
                                <select class="form-select @error('style') is-invalid @enderror" id="style" name="style" required>
                                    <option value="">選択してください</option>
                                    <option value="回転寿司" {{ old('style') == '回転寿司' ? 'selected' : '' }}>回転寿司</option>
                                    <option value="回らない寿司" {{ old('style') == '回らない寿司' ? 'selected' : '' }}>回らない寿司（カウンター・職人握り）</option>
                                    <option value="寿司居酒屋" {{ old('style') == '寿司居酒屋' ? 'selected' : '' }}>寿司居酒屋</option>
                                </select>
                            </div>

                            {{-- 価格帯（予算）選択 --}}
                            <div class="mb-3">
                                <label for="price_range" class="form-label fw-bold">価格帯（予算目安） <span class="badge bg-danger">必須</span></label>
                                <select class="form-select @error('price_range') is-invalid @enderror" id="price_range" name="price_range" required>
                                    <option value="">選択してください</option>
                                    <option value="1,000円〜2,000円" {{ old('price_range') == '1,000円〜2,000円' ? 'selected' : '' }}>1,000円〜2,000円（お気軽に）</option>
                                    <option value="3,000円〜5,000円" {{ old('price_range') == '3,000円〜5,000円' ? 'selected' : '' }}>3,000円〜5,000円（標準的）</option>
                                    <option value="5,000円〜10,000円" {{ old('price_range') == '5,000円〜10,000円' ? 'selected' : '' }}>5,000円〜10,000円（プチ贅沢）</option>
                                    <option value="10,000円以上" {{ old('price_range') == '10,000円以上' ? 'selected' : '' }}>10,000円以上（高級・特別な日に）</option>
                                </select>
                            </div>

                            {{-- 店舗紹介文 --}}
                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">店舗紹介文 <span class="badge bg-danger">必須</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="例：毎朝地元の漁港から仕入れる新鮮なマグロやとろけるサーモンが自慢のお店です。落ち着いた個室も完備しており、ご家族連れでも安心して回らないお寿司をお楽しみいただけます。夏の時期にはアジやイサキが絶品です！" required>{{ old('description') }}</textarea>
                                <div class="form-text text-muted">※ここに書かれたこだわりのネタや特徴（例: マグロ、個室など）が、トップページのキーワード検索にヒットするようになります！</div>
                            </div>

                            {{-- 店舗画像 --}}
                            <div class="mb-3">
                                <label for="image" class="form-label fw-bold">店舗画像 <span class="badge bg-secondary">任意</span></label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                <div class="form-text">※お手持ちのお寿司の写真や、店舗の画像（JPG, PNGなど）を選択してください。</div>
                            </div>

                            {{-- 営業時間 --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">営業時間 <span class="badge bg-danger">必須</span></label>
                                <div class="d-flex align-items-center">
                                    <input type="time" class="form-control @error('opening_start') is-invalid @enderror" id="opening_start" name="opening_start" value="{{ old('opening_start') }}" required>
                                    <span class="mx-2">～</span>
                                    <input type="time" class="form-control @error('opening_end') is-invalid @enderror" id="opening_end" name="opening_end" value="{{ old('opening_end') }}" required>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4">キャンセル</a>
                                <button type="submit" class="btn btn-danger px-5 shadow-sm">
                                    <i class="bi bi-check-circle"></i> この内容で登録する
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>