<x-guest-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm my-5">
                    <div class="card-header bg-dark text-white text-center py-3">
                        <h4 class="mb-0">すしコネクト - 新規会員登録</h4>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">お名前</label>
                                <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス</label>
                                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">パスワード</label>
                                <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password">
                            </div>
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">パスワード（確認用）</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark btn-lg">新規会員登録</button>
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ route('login') }}" class="text-secondary small">すでにアカウントをお持ちの方はこちら</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>