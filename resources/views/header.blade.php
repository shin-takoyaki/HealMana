<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
    <style>
        .navbar {
            background-color: #388e3c;
            border-radius: 0;
            margin-bottom: 20px;
        }

        .navbar-brand {
            font-size: 2rem;
            color: #ffffff;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        .navbar-brand:hover {
            color: #0077cc;
        }

        .navbar-nav {
            margin-left: auto;
        }

        .nav-link {
            color: #ffffff;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .nav-link:hover {
            color: #0077cc;
        }

        .nav-link::before {
            content: "\f054";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    @php
    session_start();
    @endphp
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">ヘルマネ</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">トップ</a>
                </li>
                @if (session('login_flag'))
                <li class="nav-item">
                    <a href="/profile.php" class="nav-link">プロフィール</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">ログアウト</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./signup.php">新規登録</a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</body>

</html>