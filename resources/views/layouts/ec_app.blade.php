<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Cytech EC')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    @vite(['resources/sass/app.scss','resources/js/app.js'])
</head>

<body>
    <!-- ヘッダー部 -->
    <div id="app">
    <header class="border-bottom py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="mb-0 fw-normal">Cytech EC</h1>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
                <a href="{{ route('mypage') }}" class="text-decoration-none">マイページ</a>

                @auth
                    <span>ログインユーザー：{{ auth()->user()->name }}</span>

                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">ログアウト</button>
                    </form>
                @endauth

                @guest
                    <span>Guestユーザー</span>

                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">ログイン</a>
                    @endif

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">新規登録</a>
                    @endif
                @endguest

            </div>
        </div>
    </header>

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="border-top py-4 mt-5 text-center">
        <!-- フッター部 -->
        <div class="mb-3">
            <a href="{{ route('contact.form') }}" class="btn btn-primary">お問い合わせ</a>
        </div>

        <div class="mb-3 d-flex justify-content-center gap-4">
            <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
            <a href="{{ route('mypage') }}" class="text-decoration-none">マイページ</a>
        </div>

        <p class="mb-0">&copy; 2026 Company, Inc</p>
    </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>