<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('header')
    <div class="signup-card">
        <h1>新規登録</h1>
        <form action="./signup_confirm.php" method="POST">
            @csrf
            @if($errors->has('email'))
            <div class="alert alert-danger">
                {{ $errors->first('email') }}
            </div>
            @endif
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" required>
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password" minlength="8" maxlength="30" required>
            </div>
            <div class="form-group">
                <label for="username">ユーザーネーム</label>
                <input type="text" class="form-control" id="username" name="username" maxlength="15" oninput="checkInputLength(this)" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">登録確認画面へ進む</button>
        </form>
    </div>
    @include('footer')
</body>

</html>