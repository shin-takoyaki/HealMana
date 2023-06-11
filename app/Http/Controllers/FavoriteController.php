<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // お気に入りボタンの処理
    public function toggleFavorite(Request $request)
    {
        $favoriteId = $request->input('user_id');
        $userId = auth()->user()->id;

        $favorite = Favorite::where('user_id', $userId)->where('favorite_user_id', $favoriteId)->first();
        if ($favorite) {
            $favorite->delete();
            $favoritesCount = Favorite::where('favorite_user_id', $favoriteId)->count();
            $favorited = false;
        } else {
            $newFavorite = new Favorite();
            $newFavorite->favorite_user_id = $favoriteId;
            $newFavorite->user_id = $userId;

            $newFavorite->save();
            $favoritesCount = Favorite::where('favorite_user_id', $favoriteId)->count();
            $favorited = true;
        }

        return response()->json([
            'favoritesCount' => $favoritesCount,
            'favorited' => $favorited
        ]);
    }

    // お気に入り一覧
    public function favorite_list()
    {
        $user = Auth::user();
        $favorites = Favorite::where('user_id', $user->id)->with('favorite_user')->get();
        $favorite_user = User::whereIn('id', $favorites->pluck('favorite_user_id'))->get();
        return view('favorite_list', compact('favorites', 'favorite_user'));
    }

    // 相手がお気に入りした記事一覧
    public function favorite_list_other()
    {
        $profileId = request()->get('id');
        $user = User::where('id', $profileId)->first();
        $favorites = Favorite::where('user_id', $user->id)->with('favorite_user')->get();

        return view('favorite_list', compact('favorites'));
    }

    // フォロワー一覧
    public function follower_list()
    {
        $userId = auth()->user()->id;
        $followers = Favorite::where('favorite_user_id', $userId)
            ->with(['favorite_user' => function ($query) {
                $query->select('id', 'username');
            }])
            ->get();

        $followerIds = $followers->pluck('user_id');
        $followersData = User::whereIn('id', $followerIds)->get();

        return view('follower_list', compact('followersData'));
    }
}
