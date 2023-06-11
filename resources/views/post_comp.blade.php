<!DOCTYPE html>
<html lang="ja">

<head>
    <title>投稿完了</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
    <style>
        .box {
            margin: 20px auto;
            max-width: 800px;
        }

        .body {
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            padding: 20px;
        }

        .body p {
            color: black;
            font-size: 20px;
            font-weight: bold;
        }

        .top {
            margin-top: 20px;
            text-align: center;
        }

        .body h1 {
            text-align: center;
            font-size: 2rem;
            color: #388e3c;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    @include('header')
    <div class="box">
        <div class="body">
            <h1>投稿完了</h1>
            <h2>食事</h2>
            @if (!empty($mealArray['meal_time']))
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 20%" ;>時間</th>
                            <th style="width: 80%" ;>内容</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mealArray['meal_time'] as $key => $mealTime)
                        <tr>
                            <td>{{ $mealTime }}</td>
                            <td>{{ $mealArray['meal_comment'][$key] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>食事のデータはありません。</p>
            @endif

            <h2>運動</h2>
            @if (!empty($exerciseArray['exercise_time']))
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 20%" ;>時間</th>
                            <th style="width: 80%" ;>内容</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exerciseArray['exercise_time'] as $key => $exerciseTime)
                        <tr>
                            <td>{{ $exerciseTime }}</td>
                            <td>{{ $exerciseArray['exercise_comment'][$key] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>運動のデータはありません。</p>
            @endif

            <h2>その他</h2>
            @if (!empty($otherArray['other_time']))
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 20%" ;>時間</th>
                            <th style="width: 80%" ;>内容</th>
                        </tr>
                    </thead>
                    @foreach ($otherArray['other_time'] as $key => $otherTime)
                    <tbody>
                        <tr>
                            <td>{{ $otherTime }}</td>
                            <td>{{ $otherArray['other_comment'][$key] }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            @else
            <p>その他のデータはありません。</p>
            @endif

            <h2>睡眠</h2>
            <div class="table-responsive">
                @if (!empty($rising_time) && !empty($retiring_time))
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 20%" ;>項目</th>
                            <th style="width: 80%" ;>時間</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>起床時間</td>
                            <td>{{ $rising_time }}</td>
                        </tr>
                        <tr>
                            <td>就寝時間</td>
                            <td>{{ $retiring_time }}</td>
                        </tr>
                    </tbody>
                </table>
                @else
                <p>睡眠のデータはありません。</p>
                @endif
            </div>

            <div class="top">
                <a href="./main.php">トップへ戻る</a>
            </div>
        </div>
    </div>
    @include('footer')
</body>