<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function authProviderRedirect($provider)
    {
        if ($provider) {
            return Socialite::driver($provider)->redirect();
        }
        abort(404);
    }
    public function socialAuthentication($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            $user = User::where('email', $socialUser->email)->first();

            // nếu chưa tồn tại email
            if ($user) {
                // nếu đã tồn tại email và không sử dụng cùng provider
                if ($user->auth_provider !== $provider) {
                    return redirect('login')->with('error', 'Email đã tồn tại. Vui lòng sử dụng tài khoản khác');
                }

                // nếu đã tồn tại email và sử dụng cùng provider
                Auth::login($user);
            } else {
                // tạo tài khoản mới
                $userData = User::create([
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'auth_provider' => $provider,
                    'auth_provider_id' => $socialUser->id,
                    'password' => bcrypt('password'),
                ]);

                Auth::login($userData);
            }
            return redirect()->route('dashboard');
        } catch (\Exception $ex) {
            return redirect()->route('login')->with('error', 'Đăng nhập bằng ' . ucfirst($provider) . ' thất bại. Vui lòng thử lại.');
        }
    }
}
