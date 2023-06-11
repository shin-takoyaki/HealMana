<!DOCTYPE html>
<html lang="ja">

<head>
    <title>お気に入りユーザー一覧</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
    <style>
        .user-card {
            margin: 20px;
        }

        .user-card img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-name {
            margin-top: 10px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        .user-name a {
            text-decoration: none;
            color: #333;
            transition: color 0.3s;
        }

        .user-name a:hover {
            color: #ff69b4;
        }
    </style>
</head>

<body>
    @include('header')

    <div class="container mt-5">
        <h2>お気に入りユーザー一覧</h2>
        <hr>
        <div class="row">
            @php
            $reversedContents = $favorites->reverse();
            @endphp
            @foreach ($reversedContents as $favorite)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card user-card">
                    @if ($favorite->favorite_user->avatar_image)
                    <img src="{{ asset('storage/' . $favorite->favorite_user->avatar_image) }}" alt="プロフィール画像">
                    @else
                    <img src="https://via.placeholder.com/60x60.png?text=Not+image" alt="User">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title user-name">
                            <a href="{{ route('profile.other', ['username' => $favorite->favorite_user->username]) }}">{{ $favorite->favorite_user->username }}</a>
                        </h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @include('footer')
</body>

</html>