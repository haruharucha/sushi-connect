<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 アクセス権限がありません - すしコネクト</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light d-flex flex-column justify-content-center align-items-center min-vh-screen p-4" style="min-height: 100vh;">

    <div class="card shadow border-0 text-center p-5 rounded-4" style="max-w: 450px; width: 100%;">
        
        <div class="mb-4">
            <div class="bg-danger-subtle text-danger rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 80px; height: 80px;">
                <i class="bi bi-shield-lock-fill" style="font-size: 2.5rem;"></i>
            </div>
        </div>

        <h1 class="display-4 fw-bold text-dark mb-2">403</h1>
        <h4 class="fw-bold text-secondary mb-3">アクセスが拒否されました</h4>
        
        <p class="text-muted mb-4 px-3">
            {{ $exception->getMessage() ?: '管理者権限がありません。アクセス権が必要です。' }}<br>
            <span class="small text-black-50">※このエリアは管理者アカウント専用のページです。</span>
        </p>

        <div class="d-grid gap-2 px-3">
            <a href="{{ route('home') }}" class="btn btn-danger btn-lg fw-bold shadow-sm py-2" style="transition: transform 0.2s;">
                <i class="bi bi-house-door-fill me-2"></i> トップページへ戻る
            </a>
        </div>
        
    </div>

    <div class="text-center text-muted small mt-4">
        &copy; 2026 すしコネクト. All Rights Reserved.
    </div>

</body>

</html>