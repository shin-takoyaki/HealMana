<!DOCTYPE html>
<html lang="ja">

<head>
  <title>ヘルマネ</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    .post-img {
      cursor: pointer;
    }

    .post-img img {
      width: 60px;
      position: fixed;
      right: 10px;
      bottom: 10px;
    }

    .news-feed {
      margin-bottom: 80px;
      margin-right: 120px;
      margin-left: 120px;
    }

    .post {
      background-color: #ffffff;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
    }

    .user-name:hover {
      cursor: pointer;
      color: #0077cc;
    }

    .post-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .post-content p {
      font-size: 16px;
      color: #666666;
      word-wrap: break-word;
    }

    .post-actions {
      color: #333333;
      text-decoration: none;
      font-size: 20px;
      margin-right: 10px;
    }

    .post-actions a:hover {
      color: #0077cc;
    }

    .post-time p {
      color: #333333;
      text-decoration: none;
      font-size: 12px;
      margin-right: 10px;
      text-align: end;
      margin-top: 10px;
    }

    .user-name a {
      color: inherit;
      text-decoration: none;
    }

    .user-name a:hover {
      color: #0077cc;
      text-decoration: none;
    }

    @media screen and (max-width: 896px) {
      .news-feed {
        margin-bottom: 0;
        margin-right: 0;
        margin-left: 0;
      }
    }
  </style>

  <script>
    // 称号の獲得アラート
    $(document).ready(function() {
      var alertMessage = "{{ $alertMessage ?? '' }}";
      if (alertMessage !== '') {
        alert(alertMessage);
      }
    });

    // いいねボタン
    $(document).ready(function() {
      $('.like-button').click(function() {
        var button = $(this);
        var postId = button.data('post-id');
        var form = button.closest('form');

        $.ajax({
          url: "{{ route('like.toggle') }}",
          method: "POST",
          data: form.serialize() + "&post_id=" + postId,
          success: function(response) {
            button.text('いいね ' + response.likesCount);
            if (response.likedByUser) {
              button.removeClass('btn-white').addClass('btn-pink');
            } else {
              button.removeClass('btn-pink').addClass('btn-white');
            }
          }
        });
      });
    });
  </script>
</head>

@php
session_start();
if (session('alertMessage')) {
echo '<script>
  alert("' . session('alertMessage') . '");
</script>';
}
@endphp

<body>
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

  <!-- 投稿ボタン -->
  <main>
    @if (session('login_flag'))
    <div class="post-img">
      <a href="./post.php"><img src="{{ asset('storage/images/post_img.png') }}" alt="post_img"></a>
    </div>
    @endif

    <!-- コンテンツ -->
    <div class="news-feed">
      @php
      $reversedContents = $contents->reverse();
      $perPage = 10;
      $totalPages = ceil($reversedContents->count() / $perPage);
      $currentPage = request()->query('page', 1);
      $startIndex = ($currentPage - 1) * $perPage;
      $slicedContents = $reversedContents->slice($startIndex, $perPage);
      @endphp
      @foreach ($slicedContents as $content)
      <div class="post">
        <div class="post-header">
          <div class="user-name">
            <h2>
              @if (session('login_flag'))
              @if ($content->user->avatar_image != NULL)
              <img src="{{ asset('storage/' . $content->user->avatar_image) }}" alt="プロフィール画像" class="img-fluid" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
              @else
              <img src="https://via.placeholder.com/500x500.png?text=Not+image" alt="User" class="img-fluid" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
              @endif
              <a href="{{ route('profile.other', ['username' => $content->user->username]) }}">{{ $content->user->username }}</a>
              @else
              @if ($content->user->avatar_image != NULL)
              <img src="{{ asset('storage/' . $content->user->avatar_image) }}" alt="プロフィール画像" class="img-fluid" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
              @else
              <img src="https://via.placeholder.com/500x500.png?text=Not+image" alt="User" class="img-fluid" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
              @endif
              {{ $content->user->username }}
              @endif
            </h2>
          </div>
          @if (session('login_flag'))
          <!-- いいねボタン -->
          <div class="like-container">
            <form id="like-form-{{ $content->id }}">
              @csrf
              <input type="hidden" name="post_id" value="{{ $content->id }}">
              <button data-post-id="{{ $content->id }}" type="button" class="btn btn-primary like-button border-0" style="background-color: pink;">
                いいね {{ $content->likes_count }}
              </button>
            </form>
          </div>
          @endif
        </div>
        <div class="post-content">
          <!-- 食事コンテンツ -->
          <h4>・食事</h4>
          @php $mealData = json_decode($content->meal_content, true); @endphp
          @if (!empty($mealData['meal_time']))
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 20%;">時間</th>
                  <th style="width: 80%;">内容</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($mealData['meal_time'] as $key => $mealTime)
                <tr>
                  <td>{{ $mealTime }}</td>
                  <td>{{ $mealData['meal_comment'][$key] }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @else
          <p>食事のデータはありません。</p>
          @endif
          <!-- 運動コンテンツ -->
          <h4>・運動</h4>
          @php $exerciseData = json_decode($content->exercise_content, true); @endphp
          @if (!empty($exerciseData['exercise_time']))
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 20%;">時間</th>
                  <th style="width: 80%;">内容</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($exerciseData['exercise_time'] as $key => $exerciseTime)
                <tr>
                  <td>{{ $exerciseTime }}</td>
                  <td>{{ $exerciseData['exercise_comment'][$key] }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @else
          <p>運動のデータはありません。</p>
          @endif
          <!-- その他コンテンツ -->
          <h4>・その他</h4>
          @php $otherData = json_decode($content->other_content, true); @endphp
          @if (!empty($otherData['other_time']))
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 20%;">時間</th>
                  <th style="width: 80%;">内容</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($otherData['other_time'] as $key => $otherTime)
                <tr>
                  <td>{{ $otherTime }}</td>
                  <td>{{ $otherData['other_comment'][$key] }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @else
          <p>その他のデータはありません。</p>
          @endif
          <!-- 睡眠コンテンツ -->
          <h4>・睡眠</h4>
          <div class="table-responsive">
            @if (!empty($content->rising_time) && !empty($content->retiring_time))
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 20%">項目</th>
                  <th style="width: 80%">時間</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>起床時間</td>
                  <td>
                    @if (!empty($content->rising_time))
                    {{ date('H:i', strtotime($content->rising_time)) }}
                    @else
                    起床時間のデータはありません。
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>就寝時間</td>
                  <td>
                    @if (!empty($content->retiring_time))
                    {{ date('H:i', strtotime($content->retiring_time)) }}
                    @else
                    就寝時間のデータはありません。
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
            @else
            <p>睡眠のデータはありません。</p>
            @endif
          </div>
        </div>
        <div class="post-time">
          <p>投稿日時 {{ $content->created_at }}</p>
        </div>
      </div>
      @endforeach
      @if ($totalPages > 1)
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          @for ($i = 1; $i <= $totalPages; $i++) <li class="page-item{{ $currentPage == $i ? ' active' : '' }}">
            <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
            </li>
            @endfor
        </ul>
      </nav>
      @endif
    </div>
  </main>
  @include('footer')
</body>

</html>