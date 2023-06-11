<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録確認</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('header')
    <div class="signup-card">
        <h1>登録確認</h1>
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" value="{{ $_POST['email'] }}" readonly>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" class="form-control" id="password" value="{{ $_POST['password'] }}" readonly>
        </div>
        <div class="form-group">
            <label for="username">ユーザーネーム</label>
            <input type="text" class="form-control" id="username" value="{{ $_POST['username'] }}" readonly>
        </div>
        <form action="./signup_register.php" method="post">
            @csrf
            <input type="hidden" name="email" value="{{ $_POST['email'] }}">
            <input type="hidden" name="password" value="{{ $_POST['password'] }}">
            <input type="hidden" name="username" value="{{ $_POST['username'] }}">
            <button type="submit" class="btn btn-primary btn-block">登録する</button>
        </form>
        <button onclick="history.back();" class="btn btn-secondary btn-block">戻る</button>
    </div>
    @include('footer')
</body>

</html>