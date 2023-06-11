<!DOCTYPE html>
<html>

<head>
    <title>記事編集</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    @include('header')
    <style>
        form {
            width: 375px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            font-size: 16px;
        }

        #meal_contents {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
        }

        #exercise_contents {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
        }

        #other_contents {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
        }

        #sleep_contents {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
        }

        .time_input_group {
            padding-bottom: 10px;
        }

        label {
            display: inline-block;
            text-align: right;
            margin-right: 10px;
            vertical-align: top;
        }

        select,
        textarea {
            width: 280px;
            padding: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            font-size: 16px;
            background-color: #428bca;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 30px;
            display: block;
            margin-top: 0;
            margin-bottom: 40px;
            margin-right: auto;
            margin-left: auto;
        }

        input[type="submit"] {
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #3071a9;
        }
    </style>

    <script>
        // ＋ボタンがクリックされたときに実行する関数
        function addTimeInputGroupMeal() {
            var extraTimesDiv = document.getElementById("meal_contents");
            var groupCount = extraTimesDiv.getElementsByClassName("time_input_group").length;

            if (groupCount < 8) {
                var newGroup = document.createElement("div");
                newGroup.className = "time_input_group";

                var newLabelTime = document.createElement("label");
                newLabelTime.htmlFor = "meal_time" + (groupCount + 1);
                newLabelTime.innerHTML = "食事時間";

                var newInput = document.createElement("input");
                newInput.type = "time";
                newInput.name = "meal_time" + (groupCount + 1);
                newInput.required = true;

                var newLabelComment = document.createElement("label");
                newLabelComment.htmlFor = "meal_comment" + (groupCount + 1);
                newLabelComment.innerHTML = "内容";

                var newTextArea = document.createElement("textarea");
                newTextArea.name = "meal_comment" + (groupCount + 1);
                newTextArea.placeholder = "納豆、チキンステーキ、味噌汁etc...";
                newTextArea.required = true;
                newTextArea.maxlength = 50;

                newGroup.appendChild(newLabelTime);
                newGroup.appendChild(newInput);
                newGroup.appendChild(document.createElement("br"));
                newGroup.appendChild(document.createElement("br"));
                newGroup.appendChild(newLabelComment);
                newGroup.appendChild(newTextArea);

                var removeButton = document.createElement("button");
                removeButton.type = "button";
                removeButton.innerHTML = "削除";
                removeButton.onclick = function() {
                    removeTimeInputGroup(this);
                };
                newGroup.appendChild(removeButton);

                extraTimesDiv.appendChild(newGroup);
            }
        }

        function addTimeInputGroupExercise() {
            var extraTimesDiv = document.getElementById("exercise_contents");
            var groupCount = extraTimesDiv.getElementsByClassName("time_input_group").length;

            if (groupCount < 8) {
                var newGroup = document.createElement("div");
                newGroup.className = "time_input_group";

                var newLabelTime = document.createElement("label");
                newLabelTime.htmlFor = "exercise_time" + (groupCount + 1);
                newLabelTime.innerHTML = "運動時間";

                var newInput = document.createElement("input");
                newInput.type = "time";
                newInput.name = "exercise_time" + (groupCount + 1);
                newInput.required = true;

                var newLabelComment = document.createElement("label");
                newLabelComment.htmlFor = "exercise_comment" + (groupCount + 1);
                newLabelComment.innerHTML = "内容";

                var newTextArea = document.createElement("textarea");
                newTextArea.name = "exercise_comment" + (groupCount + 1);
                newTextArea.placeholder = "腕立て伏せ30回、ジョギング20分etc...";
                newTextArea.required = true;
                newTextArea.maxlength = 50;

                newGroup.appendChild(newLabelTime);
                newGroup.appendChild(newInput);
                newGroup.appendChild(document.createElement("br"));
                newGroup.appendChild(document.createElement("br"));
                newGroup.appendChild(newLabelComment);
                newGroup.appendChild(newTextArea);

                var removeButton = document.createElement("button");
                removeButton.type = "button";
                removeButton.innerHTML = "削除";
                removeButton.onclick = function() {
                    removeTimeInputGroup(this);
                };
                newGroup.appendChild(removeButton);

                extraTimesDiv.appendChild(newGroup);
            }
        }

        function addTimeInputGroupOther() {
            var extraTimesDiv = document.getElementById("other_contents");
            var groupCount = extraTimesDiv.getElementsByClassName("time_input_group").length;

            if (groupCount < 8) {
                var newGroup = document.createElement("div");
                newGroup.className = "time_input_group";

                var newLabelTime = document.createElement("label");
                newLabelTime.htmlFor = "other_time" + (groupCount + 1);
                newLabelTime.innerHTML = "その他";

                var newInput = document.createElement("input");
                newInput.type = "time";
                newInput.name = "other_time" + (groupCount + 1);
                newInput.required = true;

                var newLabelComment = document.createElement("label");
                newLabelComment.htmlFor = "other_comment" + (groupCount + 1);
                newLabelComment.innerHTML = "内容";

                var newTextArea = document.createElement("textarea");
                newTextArea.name = "other_comment" + (groupCount + 1);
                newTextArea.placeholder = "瞑想、サウナ、サプリメントetc...";
                newTextArea.required = true;
                newTextArea.maxlength = 50;

                newGroup.appendChild(newLabelTime);
                newGroup.appendChild(newInput);
                newGroup.appendChild(document.createElement("br"));
                newGroup.appendChild(document.createElement("br"));
                newGroup.appendChild(newLabelComment);
                newGroup.appendChild(newTextArea);

                var removeButton = document.createElement("button");
                removeButton.type = "button";
                removeButton.innerHTML = "削除";
                removeButton.onclick = function() {
                    removeTimeInputGroup(this);
                };
                newGroup.appendChild(removeButton);

                extraTimesDiv.appendChild(newGroup);
            }
        }
        // 追加した要素の削除
        function removeTimeInputGroup(button) {
            var group = button.parentNode;
            group.parentNode.removeChild(group);
        }

        // Validation
        function validateTextArea() {
            var textAreas = document.getElementsByTagName("textarea");
            for (var i = 0; i < textAreas.length; i++) {
                if (textAreas[i].value.length > 50) {
                    alert("テキストは50文字以下で入力してください。");
                    return false;
                }
            }
            return true;
        }
    </script>
</head>

<body>
    <form method="POST" action="{{ route('post.register') }}" onsubmit="return validateTextArea()">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">
        <!-- 食事内容 -->
        <div id="meal_contents">
            @foreach($mealArray['meal_time'] as $key => $mealTime)
            <div class="time_input_group">
                <label for="meal_time{{ $key+1 }}">食事時間</label>
                <input type="time" name="meal_time{{ $key+1 }}" value="{{ $mealTime }}" required><br><br>

                <label for="meal_comment{{ $key+1 }}">内容</label>
                <textarea name="meal_comment{{ $key+1 }}" placeholder="納豆、チキンステーキ、味噌汁etc..." required maxlength="50">{{ $mealArray['meal_comment'][$key] }}</textarea>
                @if($key >= 1)
                <button type="button" onclick="removeTimeInputGroup(this)">削除</button>
                @endif
            </div>
            @endforeach
        </div>
        <button type="button" onclick="addTimeInputGroupMeal()">食事を追加＋</button></br></br>

        <!-- 運動内容 -->
        <div id="exercise_contents">
            @foreach($exerciseArray['exercise_time'] as $key => $exerciseTime)
            <div class="time_input_group">
                <label for="exercise_time{{ $key+1 }}">運動時間</label>
                <input type="time" name="exercise_time{{ $key+1 }}" value="{{ $exerciseTime }}" required><br><br>

                <label for="exercise_comment{{ $key+1 }}">内容</label>
                <textarea name="exercise_comment{{ $key+1 }}" placeholder="腕立て伏せ30回、ジョギング20分etc..." required maxlength="50">{{ $exerciseArray['exercise_comment'][$key] }}</textarea>
                @if($key >= 1)
                <button type="button" onclick="removeTimeInputGroup(this)">削除</button>
                @endif
            </div>
            @endforeach
        </div>
        <button type="button" onclick="addTimeInputGroupExercise()">運動を追加＋</button></br></br>

        <!-- その他 -->
        <div id="other_contents">
            @foreach($otherArray['other_time'] as $key => $otherTime)
            <div class="time_input_group">
                <label for="other_time{{ $key+1 }}">その他</label>
                <input type="time" name="other_time{{ $key+1 }}" value="{{ $otherTime }}" required><br><br>

                <label for="other_comment{{ $key+1 }}">内容</label>
                <textarea name="other_comment{{ $key+1 }}" placeholder="瞑想、サウナ、サプリメントetc..." required maxlength="50">{{ $otherArray['other_comment'][$key] }}</textarea>
                @if($key >= 1)
                <button type="button" onclick="removeTimeInputGroup(this)">削除</button>
                @endif
            </div>
            @endforeach
        </div>
        <button type="button" onclick="addTimeInputGroupOther()">その他を追加＋</button></br></br>

        <!-- 睡眠時間 -->
        <div id="sleep_contents">
            <label for="sleep_time">睡眠時間</label>
            <input type="time" name="rising_time" value="{{ $rising_time }}" required> ～ <input type="time" name="retiring_time" value="{{ $retiring_time }}" required>
        </div>

        <input type="submit" value="送信">
    </form>
    @include('footer')
</body>

</html>