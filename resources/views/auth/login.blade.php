<x-guest-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm mt-5">
                    <div class="card-header bg-dark text-white text-center py-3">
                        <h4 class="mb-0">すしコネクト - ログイン</h4>
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
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス</label>
                                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">パスワード</label>
                                <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark btn-lg">ログイン</button>
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ route('register') }}" class="text-secondary small">初めての方はこちら（新規会員登録）</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>