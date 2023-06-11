<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f5f5f5;
        }

        .container {
            margin-top: 50px;
        }

        .card-profile {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            margin-bottom: 20px;
            margin-right: auto;
            margin-left: auto;
        }

        .card {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            background-color: #fff;
        }

        .card-body p {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .profile-image {
            margin-bottom: 20px;
            text-align: center;
        }

        .profile-image img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        .profile-details h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #388e3c;
        }

        .profile-details h4 {
            font-size: 1.5rem;
            color: #555;
        }

        .profile-details h5 {
            font-size: 1.3rem;
            color: #555;
            margin-bottom: 30px;
        }

        .profile-details ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .profile-details ul li {
            display: inline-block;
            margin-right: 20px;
            color: #777;
        }

        .profile-details ul li span {
            font-weight: bold;
            color: #555;
        }

        .profile-description {
            font-size: 1.1rem;
            line-height: 1.5;
            color: #333;
            margin-top: 20px;
        }

    </style>
</head>

<body>
    @include('header')
    <div class="container">
        <div class="card-profile">
            <div class="profile-image">
                @if ($profile->avatar_image != NULL)
                <img src="{{ asset('storage/' . $profile->avatar_image) }}" alt="プロフィール画像" class="img-fluid" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                @else
                <img src="https://via.placeholder.com/500x500.png?text=Not+image" alt="User" class="img-fluid" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                @endif
            </div>
            <!-- お気に入り -->
            <div class="favorite-container text-center">
                <form id="favorite-form-{{ $profile->id }}" class="d-flex justify-content-center">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $profile->id }}">
                    <button data-user-id="{{ $profile->id }}" type="button" class="btn btn-primary favorite-button black border-0" style="background-color: skyblue;">
                        お気に入り {{ $favorites }}
                    </button>
                </form>
            </div>
            <div class="profile-details">
                <h2>{{ $profile->username }}</h2>
                <h4>称号: {{ $selected_title }}</h4>
                <ul>
                    <li><span>ログイン日数:</span> {{ $profile->num_logins }}</li>
                    <li><span>連続ログイン日数:</span> {{ $profile->consecutive_login_days }}</li>
                    <li><span>最高連続ログイン日数:</span> {{ $profile->highest_consecutive_login_days }}</li>
                </ul>
                <ul>
                    <li><span>投稿数:</span> {{ count($posts) }}</li>
                    <li><span>リカバリー日数:</span> {{ $profile->recovery_days }}</li>
                </ul>
                <div class="profile-description">
                    <p>
                        {{ $profile->profile_details }}
                    </p>
                </div>
            </div>
            <div class="d-grid gap-2 mt-2">
                <a href="{{ route('like.list.other') }}?id={{ $profile->id }}" class="btn btn-outline-primary">{{ $profile->username }}がいいねした記事一覧</a>
                <a href="{{ route('favorite.list.other') }}?id={{ $profile->id }}" class="btn btn-outline-primary">{{ $profile->username }}がお気に入りしたユーザー一覧</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @php
            $reversedContents = $posts->reverse();
            @endphp
            @foreach ($reversedContents as $post)
            @php $mealData = json_decode($post->meal_content, true); @endphp
            @php $exerciseData = json_decode($post->exercise_content, true); @endphp
            @php $otherData = json_decode($post->other_content, true); @endphp

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">投稿日時: {{ $post->created_at }}</h6>
                        <p class="card-text">
                            <!-- 食事データの表示 -->
                            @foreach ($mealData['meal_time'] as $key => $mealTime)
                            <tr>
                                <td>【食事】</td>
                                <td>{{ $mealTime }}</td>
                                <td>{{ $mealData['meal_comment'][$key] }}</td>
                            </tr>
                            @endforeach
                            <!-- 運動データの表示 -->
                            @foreach ($exerciseData['exercise_time'] as $key => $exerciseTime)
                            <tr>
                                <td>【運動】</td>
                                <td>{{ $exerciseTime }}</td>
                                <td>{{ $exerciseData['exercise_comment'][$key] }}</td>
                            </tr>
                            @endforeach
                            <!-- その他データの表示 -->
                            @foreach ($otherData['other_time'] as $key => $otherTime)
                            <tr>
                                <td>【その他】</td>
                                <td>{{ $otherTime }}</td>
                                <td>{{ $otherData['other_comment'][$key] }}</td>
                            </tr>
                            @endforeach
                            <!-- 睡眠データの表示 -->
                            <tr>
                                <td>【起床時間】</td>
                                <td>
                                    @if (!empty($post->rising_time))
                                    {{ date('H:i', strtotime($post->rising_time)) }}
                                    @else
                                    起床時間のデータはありません。
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>【就寝時間】</td>
                                <td>
                                    @if (!empty($post->retiring_time))
                                    {{ date('H:i', strtotime($post->retiring_time)) }}
                                    @else
                                    就寝時間のデータはありません。
                                    @endif
                                </td>
                            </tr>
                        </p>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#postModal-{{ $post->id }}">詳細を見る</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- モーダル -->
            <div class="modal fade" id="postModal-{{ $post->id }}" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="postModalLabel">投稿の詳細</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="post">
                                <h4>・食事</h4>
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
                                @foreach ($exerciseData['exercise_time'] as $key => $exerciseTime)
                                <h4>・運動</h4>
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
                                @endforeach
                                @foreach ($otherData['other_time'] as $key => $otherTime)
                                <h4>・その他</h4>
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
                                @endforeach
                                <h4>・睡眠</h4>
                                <div class="table-responsive">
                                    @if (!empty($post->rising_time) && !empty($post->retiring_time))
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
                                                    @if (!empty($post->rising_time))
                                                    {{ date('H:i', strtotime($post->rising_time)) }}
                                                    @else
                                                    起床時間のデータはありません。
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>就寝時間</td>
                                                <td>
                                                    @if (!empty($post->retiring_time))
                                                    {{ date('H:i', strtotime($post->retiring_time)) }}
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
                                <p>投稿日時 {{ $post->created_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @include('footer')
</body>

<script>
    // 記事の詳細
    const detailButtons = document.querySelectorAll('.btn-link');
    detailButtons.forEach(button => {
        button.addEventListener('click', () => {
            const cardBody = button.closest('.card-body');
            const postDate = cardBody.querySelector('.card-title').textContent;
            const postContent = cardBody.querySelector('.card-text').textContent;
            const modalBody = document.querySelector('#postModal .modal-body');
            modalBody.innerHTML = `<p><strong>投稿日時:</strong> ${postDate}</p><p><strong>投稿内容:</strong> ${postContent}</p>`;
            const postModal = new bootstrap.Modal(document.getElementById('postModal'));
            postModal.show();
        });
    });

    // お気に入りの処理
    $(document).ready(function() {
        $('.favorite-button').click(function() {
            var button = $(this);
            var userId = button.data('user-id');
            var form = button.closest('form');

            $.ajax({
                url: "{{ route('favorite.toggle') }}",
                method: "POST",
                data: form.serialize() + "&user_id=" + userId,
                success: function(response) {
                    button.text('お気に入り ' + response.favoritesCount);
                    if (response.favoritedByUser) {
                        button.removeClass('btn-white').addClass('btn-pink');
                    } else {
                        button.removeClass('btn-pink').addClass('btn-white');
                    }
                }
            });
        });
    });
</script>