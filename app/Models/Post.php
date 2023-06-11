<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class Post extends Model
{
    // 記事に対するいいね数のカウント
    protected $appends = ['likes_count'];
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function post_contents($user_id, $mealArray, $exerciseArray, $otherArray, $rising_time, $retiring_time)
    {
        $this->user_id = $user_id;
        $this->meal_content = $mealArray;
        $this->exercise_content = $exerciseArray;
        $this->other_content = $otherArray;
        $this->rising_time = $rising_time;
        $this->retiring_time = $retiring_time;
        $this->save();
    }

    public function post_edit($post_id, $mealArray, $exerciseArray, $otherArray, $rising_time, $retiring_time)
    {
        $post = Post::find($post_id);
        $post->meal_content = $mealArray;
        $post->exercise_content = $exerciseArray;
        $post->other_content = $otherArray;
        $post->rising_time = $rising_time;
        $post->retiring_time = $retiring_time;
        $post->save();
    }

    public function num_likes($likesCount, $postId)
    {
        $post = Post::find($postId);
        if ($post) {
            $post->num_likes = $likesCount;
            $post->save();
        }
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function likedByUser()
    {
        return $this->likes()
            ->where('user_id', auth()->user()->id);
    }
}
