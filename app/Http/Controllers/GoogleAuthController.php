<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleAuthController extends Controller
{
  //
  public function redirectToGoogle()
  {
    return Socialite::driver('google')->redirect();
  }
  public function handleGoogleCallback()
  {
    $google_user = Socialite::driver('google')->user();
    $exist_user = User::where('email', $google_user->email)->first();
    if ($exist_user) {

      Auth::login($exist_user);
    } else {
      $new_user = User::updateOrCreate(
        ['email' => $google_user->email], // 🔍 البحث عن المستخدم عبر البريد الإلكتروني فقط
        [
          'name' => $google_user->name,
          'google_id' => $google_user->id,
          'password' => bcrypt(Str::random(16)), // كلمة مرور عشوائية
          'profile_photo_path' => $google_user->avatar,
        ]
      );
      Auth::login($new_user);
    }
    return redirect()->route('home');
  }
}
