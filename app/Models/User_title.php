<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User_title extends Model
{
    protected $table = 'user_titles';
    // 新規会員登録
    public function user_title($generatedId)
    {
        $user = new User_title;
        $user->user_id = $generatedId;
        $user->title_id = 1;
        $user->save();
    }
}
