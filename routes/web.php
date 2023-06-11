<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// UserController
Route::get('/', 'UserController@main');
Route::get('/main.php', 'UserController@main')->name('main');
Route::get('/login/count', 'UserController@login_count')->name('login.count');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::post('/main.php', 'UserController@access')->name('access');
Route::post('/signup_register.php', 'UserController@signup_register');
Route::get('/profile.php', 'UserController@profile');
Route::get('/profile_edit.php', 'UserController@profile_edit')->name('profile.edit');
Route::post('/profile_update', 'UserController@profile_update')->name('profile.update');
Route::get('/profile_other/{username}', 'UserController@profile_other')->name('profile.other');
Route::post('/user/delete', 'UserController@destroy')->name('user.delete');

// PostController
Route::post('/post_comp.php', 'PostController@post_comp')->name('post_comp');
Route::get('/post_edit/{id}', 'PostController@edit')->name('post.edit');
Route::post('/post_register', 'PostController@post_register')->name('post.register');
Route::delete('/post/delete/{id}', 'PostController@delete')->name('post.delete');

// LikeController
Route::get('/like_list', 'LikeController@like_list')->name('like.list');
Route::get('/like_list_other', 'LikeController@like_list_other')->name('like.list.other');
Route::post('/like', 'LikeController@toggleLike')->name('like.toggle');

// FavoriteController
Route::get('/favorite_list.php', 'FavoriteController@favorite_list')->name('favorite.list');
Route::get('/favorite_list_other.php', 'FavoriteController@favorite_list_other')->name('favorite.list.other');
Route::get('/follower_list.php', 'FavoriteController@follower_list')->name('follower.list');
Route::post('/favorite', 'FavoriteController@toggleFavorite')->name('favorite.toggle');


Route::get('/post.php', function () {
    return view('post');
});
Route::get('/login.php', function () {
    return view('login');
})->name('login');
Route::get('/signup.php', function () {
    return view('signup');
});
Route::match(['get', 'post'], '/signup_confirm.php', function () {
    return view('signup_confirm');
});
