<!DOCTYPE html>
<html lang="ja">

<head>
    <title>フォロワー一覧</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
    <style>
        .card {
            margin-bottom: 20px;
        }

        .user-card img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            margin-top: 10px;
        }

        .user-name {
            margin-top: 10px;
            font-size: 20px;
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
        <h2>フォロワー一覧</h2>
        <hr>
        <div class="row">
            @php
            $reversedFollowers = $followersData->reverse();
            @endphp
            @foreach ($reversedFollowers as $follower)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card user-card col-12 text-center">
                    <div class="user-image">
                        @if ($follower->avatar_image)
                        <img src="{{ asset('storage/' . $follower->avatar_image) }}" alt="プロフィール画像" class="img-fluid">
                        @else
                        <img src="https://via.placeholder.com/60x60.png?text=Not+image" alt="User" class="img-fluid">
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title user-name">
                            <a href="{{ route('profile.other', ['username' => $follower->username]) }}">{{ $follower->username }}</a>
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