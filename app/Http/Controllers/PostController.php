<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    // 記事投稿完了
    public function post_comp(Request $request)
    {
        $user_id = Auth::id();
        $mealArray = [];
        for ($i = 1; $i <= 8; $i++) {
            if ($request->has('meal_time' . $i) && $request->has('meal_comment' . $i)) {
                $meal_time = $request->input('meal_time' . $i);
                $meal_comment = $request->input('meal_comment' . $i);
                $mealArray['meal_time'][$i] = $meal_time;
                $mealArray['meal_comment'][$i] = $meal_comment;
            }
        }

        $exerciseArray = [];
        for ($i = 1; $i <= 8; $i++) {
            if ($request->has('exercise_time' . $i) && $request->has('exercise_comment' . $i)) {
                $exercise_time = $request->input('exercise_time' . $i);
                $exercise_comment = $request->input('exercise_comment' . $i);
                $exerciseArray['exercise_time'][$i] = $exercise_time;
                $exerciseArray['exercise_comment'][$i] = $exercise_comment;
            }
        }

        $otherArray = [];
        for ($i = 1; $i <= 8; $i++) {
            if ($request->has('other_time' . $i) && $request->has('other_comment' . $i)) {
                $other_time = $request->input('other_time' . $i);
                $other_comment = $request->input('other_comment' . $i);
                $otherArray['other_time'][$i] = $other_time;
                $otherArray['other_comment'][$i] = $other_comment;
            }
        }

        $rising_time = $request->input('rising_time');
        $retiring_time = $request->input('retiring_time');

        $post = new Post;
        $post->post_contents(
            $user_id,
            json_encode($mealArray),
            json_encode($exerciseArray),
            json_encode($otherArray),
            $rising_time,
            $retiring_time
        );

        return view('post_comp', compact('mealArray', 'exerciseArray', 'otherArray', 'rising_time', 'retiring_time'));
    }

    // 記事編集
    public function edit($id)
    {
        $content = Post::find($id);
        if ($content) {
            // 食事
            $meal_content = $content['meal_content'];
            $meal_array = json_decode($meal_content, true);
            $mealArray = array();
            foreach ($meal_array['meal_time'] as $key => $value) {
                $mealArray['meal_time'][] = $value;
                $mealArray['meal_comment'][] = $meal_array['meal_comment'][$key];
            }
            // 運動
            $exercise_content = $content['exercise_content'];
            $exercise_array = json_decode($exercise_content, true);
            $exerciseArray = array();
            foreach ($exercise_array['exercise_time'] as $key => $value) {
                $exerciseArray['exercise_time'][] = $value;
                $exerciseArray['exercise_comment'][] = $exercise_array['exercise_comment'][$key];
            }
            // その他
            $other_content = $content['other_content'];
            $other_array = json_decode($other_content, true);
            $otherArray = array();
            foreach ($other_array['other_time'] as $key => $value) {
                $otherArray['other_time'][] = $value;
                $otherArray['other_comment'][] = $other_array['other_comment'][$key];
            }
            // 睡眠
            $rising_time = date("H:i", strtotime($content['rising_time']));
            $retiring_time = date("H:i", strtotime($content['retiring_time']));
            return view('post_edit', compact('mealArray', 'exerciseArray', 'otherArray', 'rising_time', 'retiring_time', 'id'));
        }
        return response()->json(['success' => false, 'message' => '記事が見つかりませんでした。']);
    }

    // 記事編集完了
    public function post_register(Request $request)
    {
        $post_id = $request->input('id');
        $mealArray = [];
        for ($i = 1; $i <= 8; $i++) {
            if ($request->has('meal_time' . $i) && $request->has('meal_comment' . $i)) {
                $meal_time = $request->input('meal_time' . $i);
                $meal_comment = $request->input('meal_comment' . $i);
                $mealArray['meal_time'][$i] = $meal_time;
                $mealArray['meal_comment'][$i] = $meal_comment;
            }
        }

        $exerciseArray = [];
        for ($i = 1; $i <= 8; $i++) {
            if ($request->has('exercise_time' . $i) && $request->has('exercise_comment' . $i)) {
                $exercise_time = $request->input('exercise_time' . $i);
                $exercise_comment = $request->input('exercise_comment' . $i);
                $exerciseArray['exercise_time'][$i] = $exercise_time;
                $exerciseArray['exercise_comment'][$i] = $exercise_comment;
            }
        }

        $otherArray = [];
        for ($i = 1; $i <= 8; $i++) {
            if ($request->has('other_time' . $i) && $request->has('other_comment' . $i)) {
                $other_time = $request->input('other_time' . $i);
                $other_comment = $request->input('other_comment' . $i);
                $otherArray['other_time'][$i] = $other_time;
                $otherArray['other_comment'][$i] = $other_comment;
            }
        }

        $rising_time = $request->input('rising_time');
        $retiring_time = $request->input('retiring_time');

        $post = new Post;
        $post->post_edit(
            $post_id,
            json_encode($mealArray),
            json_encode($exerciseArray),
            json_encode($otherArray),
            $rising_time,
            $retiring_time
        );
        return view('post_register');
    }

    // 記事の削除
    public function delete($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => '記事が見つかりませんでした。']);
    }
}
