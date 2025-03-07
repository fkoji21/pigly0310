<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PiGLy')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    {{-- ヘッダー（デフォルト表示） --}}
    @section('header')
    <header class="header ontainer-fluid">
        <div class="header__inner">
            <a class="header__logo" href="/">PiGLy</a>
            @if (Auth::check())
            <nav>
                <ul class="header-nav">
                    <li class="header-nav__item">
                        <a class="header-nav__link btn-icon" href="{{ route('weight_logs.goal_setting') }}"><i class="fa-solid fa-bullseye"></i>目標体重設定</a>
                    </li>
                    <li class="header-nav__item">
                        <form class="form" action="/logout" method="post">
                            @csrf
                            <button class="header-nav__button btn-icon"><i class="fa-solid fa-right-from-bracket"></i> ログアウト</button>
                        </form>
                    </li>
                </ul>
            </nav>
            @endif
        </div>
    </header>
    @show

    <main>
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>