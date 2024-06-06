<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.LoginPalingBaru');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            // 'captcha' => ['required', new CaptchaCheck]
        ])->validate();

        if (!Auth::attempt($request->only('email','password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $user = User::where('id', Auth::user()->id)->first();
        $user->log_user = 'login';
        $user->tanggal_login = Carbon::now()->toDateTimeString();
        $user->update();

        $request->session()->regenerate();

        $route_get = User::GetFirstRoute()->first();
        return redirect(route('dashboard'))->with('toast_success', 'Welcome Back! ' . Auth::user()->name);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/landing_page'); // Redirect to landing_page after logout
    }

    // public function reloadCaptcha()
    // {
    //     return response()->json(['captcha' => captcha_img('flat')]);
    // }
}
