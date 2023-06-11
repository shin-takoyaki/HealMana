<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
    <style>
        .login-card {
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            margin-right: auto;
            margin-left: auto;
        }

        .login-card h1 {
            text-align: center;
            font-size: 2rem;
            color: #388e3c;
            margin-bottom: 30px;
        }

        .login-card input {
            margin-bottom: 20px;
        }

        .login-card button {
            margin-top: 20px;
        }

        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }

        .forgot-password a {
            color: #388e3c;
        }
    </style>

    <script>
        let forgotPasswordModal = document.getElementById('forgotPasswordModal');
        let modalToggle = document.querySelector('[href="#forgotPasswordModal"]');
        let modalDismiss = document.querySelector('[data-bs-dismiss="modal"]');

        modalToggle.addEventListener('click', function(e) {
            e.preventDefault();
            forgotPasswordModal.classList.add('show');
            forgotPasswordModal.style.display = 'block';
            document.body.classList.add('modal-open');
        });

        modalDismiss.addEventListener('click', function() {
            forgotPasswordModal.classList.remove('show');
            forgotPasswordModal.style.display = 'none';
            document.body.classList.remove('modal-open');
        });
    </script>
</head>

<body>
    @include('header')
    <div class="login-card">
        <h1>ログイン</h1>
        <form action="{{ route('access') }}" method="POST">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
            @endif
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" required>
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">ログイン</button>
        </form>
    </div>
    @include('footer')
</body>