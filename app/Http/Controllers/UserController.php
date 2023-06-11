<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Favorite;
use App\Models\Title;
use App\Models\User_title;
use Carbon\Carbon;

class UserController extends Controller
{
    // メインページ
    public function main()
    {
        $users = User::all();
        $contents = Post::with('user')->get();

        foreach ($contents as $content) {
            $content->loadCount('likes');
        }

        return view('main', compact('users', 'contents'));
    }

    // ログイン
    public function access(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            Session::put('login_flag', true);
            return redirect()->route('login.count');
        } else {
            return redirect()->back()->withErrors(['error' => 'メールアドレスまたはパスワードが間違っています。']);
        }
    }

    // ログイン日数のカウント
    public function login_count()
    {
        $login_user = Auth::user();
        $user = User::find($login_user->id);
        $postCount = Post::where('user_id', $login_user->id)->count();

        // 称号の獲得
        $this->checkTitle($user, $postCount);

        return redirect()->route('main');
    }

    // 称号のチェックと獲得
    private function checkTitle(User $user, int $postCount)
    {
        $consecutiveLoginCount = $user->consecutive_login_days;
        $highestConsecutiveLoginCount = $user->highest_consecutive_login_days;
        $recoveryDays = $user->recovery_days;
        $currentDate = Carbon::today();
        $lastLoginDate = Carbon::parse($user->last_login)->startOfDay();

        if (!$currentDate->isSameDay($lastLoginDate)) {
            if ($lastLoginDate->diffInDays($currentDate) === 1) {
                if ($consecutiveLoginCount === 2) {
                    $recoveryDays += 1;
                }
                $consecutiveLoginCount += 1;

                if ($consecutiveLoginCount >= $highestConsecutiveLoginCount) {
                    $highestConsecutiveLoginCount = $consecutiveLoginCount;
                }
            } else {
                $consecutiveLoginCount = 1;
                if ($consecutiveLoginCount >= $highestConsecutiveLoginCount) {
                    $highestConsecutiveLoginCount = $consecutiveLoginCount;
                }
            }

            $user->last_login = Carbon::now()->startOfDay();
            $user->consecutive_login_days = $consecutiveLoginCount;
            $user->highest_consecutive_login_days = $highestConsecutiveLoginCount;
            $user->recovery_days = $recoveryDays;
            $user->num_logins += 1;
            $user->save();
        }

        $titleId = $this->getTitleId($user, $postCount);

        if ($titleId) {
            $userTitle = new User_title();
            $userTitle->user_id = $user->id;
            $userTitle->title_id = $titleId;
            $userTitle->save();

            session()->flash('alertMessage', $this->getTitleMessage($titleId));
        }
    }

    // 称号のIDを取得
    private function getTitleId(User $user, int $postCount): ?int
    {
        $numLogins = $user->num_logins;
        $consecutiveLoginDays = $user->consecutive_login_days;
        $recovery_days = $user->recovery_days;

        if ($numLogins == 3) {
            return 2;
        } elseif ($numLogins == 7) {
            return 3;
        } elseif ($numLogins == 30) {
            return 4;
        } elseif ($numLogins == 90) {
            return 5;
        } elseif ($numLogins == 365) {
            return 6;
        } elseif ($consecutiveLoginDays == 7) {
            return 7;
        } elseif ($consecutiveLoginDays == 30) {
            return 8;
        } elseif ($consecutiveLoginDays == 90) {
            return 9;
        } elseif ($postCount == 10) {
            return 10;
        } elseif ($postCount == 100) {
            return 11;
        } elseif ($postCount == 300) {
            return 12;
        } elseif ($recovery_days == 3) {
            return 13;
        } elseif ($recovery_days == 10) {
            return 14;
        } elseif ($recovery_days == 100) {
            return 15;
        }

        return null;
    }

    // 称号に対するメッセージを取得
    private function getTitleMessage(int $titleId): string
    {
        switch ($titleId) {
            case 2:
                return "称号「健康の発芽者」を獲得しました！プロフィール編集フォームより称号を変更することができます。";
            case 3:
                return "おめでとうございます。称号「健康の進化者」を獲得しました！";
            case 4:
                return "素敵です。称号「ライフスタイル・アンバサダー」を獲得しました！";
            case 5:
                return "尊敬致します。称号「ウェルネス・プロフェッショナル」を獲得しました！";
            case 6:
                return "もうあなたは大丈夫。称号「マスター・オブ・ヘルス」を獲得しました！";
            case 7:
                return "おめでとうございます。称号「習慣の航海者」を獲得しました！";
            case 8:
                return "素敵です。称号「ルーティン・エキスパート」を獲得しました！";
            case 9:
                return "その自制心があれば問題ないです。称号「マスター・オブ・ハビッツ」を獲得しました！";
            case 10:
                return "称号「コンテンツ・イニシエーター」を獲得しました！プロフィール編集フォームより称号を変更することができます。";
            case 11:
                return "おめでとうございます。称号「マスター・コンテンツ・クリエイター」を獲得しました！";
            case 12:
                return "素晴らしいです。称号「インフルエンシャル・エキスパート」を獲得しました！";
            case 13:
                return "継続しようとする気持ち、とても大切です。称号「初心者の闘志」を獲得しました！";
            case 14:
                return "あなたならきっと成功できます。。称号「不屈の戦士」を獲得しました！";
            case 15:
                return "もはや才能です。称号「不滅の英雄」を獲得しました！";
            default:
                return "";
        }
    }

    // ログアウト
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    // プロフィール
    public function profile()
    {
        $user = Auth::user();
        $profile = User::where('id', $user->id)->first();
        $user_titles = User_title::where('user_id', $user->id)->get();
        $favorites = Favorite::where('favorite_user_id', $profile->id)->count();
        $title_ids = $user_titles->pluck('title_id');
        $titles = Title::whereIn('id', $title_ids)->get();
        $selected_id = $user->selected_title_id;
        $selected_title = $titles->firstWhere('id', $selected_id)->title;
        $posts = Post::where('user_id', $user->id)->get();
        return view('profile', compact('profile', 'user_titles', 'titles', 'selected_title', 'posts', 'favorites'));
    }

    // 相手のプロフィール
    public function profile_other($username)
    {
        $loggedInUser = Auth::user();
        if ($loggedInUser->username == $username) {
            return $this->profile();
        }
        $profile = User::where('username', $username)->first();
        $user_titles = User_title::where('user_id', $profile->id)->get();
        $favorites = Favorite::where('favorite_user_id', $profile->id)->count();
        $title_ids = $user_titles->pluck('title_id');
        $titles = Title::whereIn('id', $title_ids)->get();
        $selected_id = $profile->selected_title_id;
        $selected_title = $titles->firstWhere('id', $selected_id)->title;
        $posts = Post::where('user_id', $profile->id)->get();
        return view('profile_other', compact('profile', 'user_titles', 'titles', 'selected_title', 'posts', 'favorites'));
    }

    // プロフィール編集画面
    public function profile_edit()
    {
        $user = Auth::user();
        $profile = User::where('id', $user->id)->first();
        $userTitleIds = User_title::where('user_id', $user->id)->pluck('title_id')->toArray();
        $titles = Title::whereIn('id', $userTitleIds)->get();

        return view('profile_edit', compact('profile', 'titles'));
    }

    // プロフィール更新
    public function profile_update(Request $request)
    {
        $username = $request->request->get('username');
        $profilePicture = $request->file('profile_picture');
        $titleId = $request->request->get('user-title');
        $profileDetails = $request->input('profile_content');

        $user = Auth::user();
        $user = User::find($user->id);
        $user->username = $username;
        $user->selected_title_id = $titleId;
        $user->profile_details = $profileDetails;

        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $filename = time() . '_' . $profilePicture->getClientOriginalName();
            $path = $profilePicture->storeAs('profile_pictures', $filename, 'public');
            $user->avatar_image = $path;
        }

        $user->save();

        return view('profile_register');
    }

    // 新規会員登録
    public function signup_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'string', 'min:8'],
            'username' => ['required', 'string', 'max:15'],
        ], [
            'email.unique' => 'すでに登録されているアカウントです。',
        ]);

        if ($validator->fails()) {
            return redirect('/signup.php')
                ->withErrors($validator)
                ->withInput();
        }

        $usersModel = new User;
        $generatedId = $usersModel->signup_register($request);

        $userTitlesModel = new User_title;
        $userTitlesModel->user_title($generatedId);

        return view('signup_register');
    }

    // アカウント削除
    public function destroy(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $userId = $user->id;
            User::where('id', $userId)->delete();
            Post::where('user_id', $userId)->delete();
            Like::where('user_id', $userId)->delete();
            Like::where('post_id', $userId)->delete();
            User_title::where('user_id', $userId)->delete();
            Favorite::where('user_id', $userId)->delete();
            Favorite::where('favorite_user_id', $userId)->delete();
            Auth::logout();
            Session::flush();
            return Redirect::to('/')->with('success', 'アカウントが削除されました。');
        }
    }
}
