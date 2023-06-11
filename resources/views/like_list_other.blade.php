<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>いいねリスト</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f5f5f5;
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

        .title {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-top: 50px;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
    </style>
</head>

<body>
    @include('header')
    <div class="container mt-5">
        <h2>いいねした記事一覧</h2>
        <hr>
        <div class="row">
            @php
            $reversedContents = $likes->reverse();
            @endphp
            @foreach ($reversedContents as $like)
            @if (!empty($like->post))
            @php $mealData = json_decode($like->post->meal_content, true); @endphp
            @php $exerciseData = json_decode($like->post->exercise_content, true); @endphp
            @php $otherData = json_decode($like->post->other_content, true); @endphp
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h4><a href="{{ route('profile.other', ['username' => $like->post->user->username]) }}" style="text-decoration:none; color: #333; transition: color 0.3s;" >投稿者: {{ $like->post->user->username }}</a></h4>
                        <p class="card-text">
                            @foreach ($mealData['meal_time'] as $key => $mealTime)
                            <tr>
                                <td>【食事】</td>
                                <td>{{ $mealTime }}</td>
                                <td>{{ $mealData['meal_comment'][$key] }}</td>
                            </tr>
                            @endforeach
                            @foreach ($exerciseData['exercise_time'] as $key => $exerciseTime)
                            <tr>
                                <td>【運動】</td>
                                <td>{{ $exerciseTime }}</td>
                                <td>{{ $exerciseData['exercise_comment'][$key] }}</td>
                            </tr>
                            @endforeach
                            @foreach ($otherData['other_time'] as $key => $otherTime)
                            <tr>
                                <td>【その他】</td>
                                <td>{{ $otherTime }}</td>
                                <td>{{ $otherData['other_comment'][$key] }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>【起床時間】</td>
                                <td>
                                    @if (!empty($like->rising_time))
                                    {{ date('H:i', strtotime($like->rising_time)) }}
                                    @else
                                    起床時間のデータはありません。
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>【就寝時間】</td>
                                <td>
                                    @if (!empty($like->retiring_time))
                                    {{ date('H:i', strtotime($like->retiring_time)) }}
                                    @else
                                    就寝時間のデータはありません。
                                    @endif
                                </td>
                            </tr>
                        </p>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#postModal-{{ $like->post->id }}">詳細を見る</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- モーダル -->
            <div class="modal fade" id="postModal-{{ $like->post->id }}" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
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
                                    @if (!empty($like->post->rising_time) && !empty($like->post->retiring_time))
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
                                                    @if (!empty($like->post->rising_time))
                                                    {{ date('H:i', strtotime($like->post->rising_time)) }}
                                                    @else
                                                    起床時間のデータはありません。
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>就寝時間</td>
                                                <td>
                                                    @if (!empty($like->post->retiring_time))
                                                    {{ date('H:i', strtotime($like->post->retiring_time)) }}
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
                                <p>投稿日時 {{ $like->post->created_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    @include('footer')
</body>

<script>
    const detailButtons = document.querySelectorAll('.btn-link'); // 「詳細」ボタンを取得
    detailButtons.forEach(button => {
        button.addEventListener('click', () => { // クリックしたときの処理を登録
            const cardBody = button.closest('.card-body'); // クリックされたボタンの一番近い「card-body」要素を取得
            const postDate = cardBody.querySelector('.card-title').textContent; // 投稿日時を取得
            const postContent = cardBody.querySelector('.card-text').textContent; // 投稿内容を取得
            const modalBody = document.querySelector('#postModal .modal-body'); // モーダルの中身を取得
            modalBody.innerHTML = `<p><strong>投稿日時:</strong> ${postDate}</p><p><strong>投稿内容:</strong> ${postContent}</p>`; // 中身を更新
            const postModal = new bootstrap.Modal(document.getElementById('postModal')); // モーダルを表示
            postModal.show();
        });
    });
</script>