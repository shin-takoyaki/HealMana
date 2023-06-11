<!DOCTYPE html>
<html lang="en">

<head>
    <title>プロフィール編集</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
    <style>
        .container {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            margin-bottom: 20px;
            margin-right: auto;
            margin-left: auto;
            border-radius: 10px;
            padding: 20px;
        }

        .row {
            padding-top: 20px;
        }

        .form-group.row {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    @include('header')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-4">プロフィール編集</h2>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="profile-picture" class="col-sm-3 col-form-label">プロフィール写真</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control-file" id="profile-picture" name="profile_picture"></br>
                            @if ($profile->avatar_image)
                            <small>現在の画像: <a href="{{ asset($profile->avatar_image) }}" target="_blank">{{ $profile->avatar_image }}</a></small>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">ユーザー名</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username" value="{{ $profile->username }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user-title" class="col-sm-3 col-form-label">称号</label>
                        <div class="col-sm-9">
                            <select name="user-title" id="user-title" class="form-control">
                                @foreach($titles as $title)
                                <option value="{{ $title->id }}" @if($profile->selected_title_id == $title->id) selected @endif>
                                    {{ $title->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="profile-content" class="col-sm-3 col-form-label">プロフィール詳細</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="profile-content" name="profile_content" placeholder="健康的な活動をサボった未来について書いてみよう。例：糖分をとりすぎて糖尿病に。そして手足の切断することになるかもしれない。" rows="4" style="resize: none;">{{ $profile->profile_details }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary">保存する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('footer')

</body>

</html>