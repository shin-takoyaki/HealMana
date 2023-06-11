<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
{
    // いいねボタンの処理
    public function toggleLike(Request $request)
    {
        $postId = $request->input('post_id');
        $userId = auth()->user()->id;

        $like = Like::where('post_id', $postId)->where('user_id', $userId)->first();

        if ($like) {
            $like->delete();
            $likesCount = Like::where('post_id', $postId)->count();
            $liked = false;
        } else {
            $newLike = new Like();
            $newLike->post_id = $postId;
            $newLike->user_id = $userId;

            $newLike->save();
            $likesCount = Like::where('post_id', $postId)->count();
            $liked = true;
        }

        $post = new Post;
        $post->num_likes($likesCount, $postId);

        return response()->json([
            'likesCount' => $likesCount,
            'liked' => $liked
        ]);
    }

    // いいねした記事一覧
    public function like_list()
    {
        $user = Auth::user();
        $likes = Like::where('user_id', $user->id)->with('post')->get();

        return view('like_list', compact('likes'));
    }

    // 相手がいいねした記事一覧
    public function like_list_other()
    {
        $profileId = request()->get('id');
        $user = User::where('id', $profileId)->first();
        $likes = Like::where('user_id', $user->id)->with('post')->get();

        return view('like_list_other', compact('likes'));
    }
}
