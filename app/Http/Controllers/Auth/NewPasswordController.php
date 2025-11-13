<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        if (!$request->has('email') || !User::where('email', $request->email)->exists()) {
        return redirect()
            ->route('password.request') // Forgot Password route
            ->withErrors(['email' => __('This email does not exist in our records.')]);
        }
        return view('web.auth.reset-password', ['email' => $request->email]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'email' => 'required|email|exists:users,email',
            'token' => 'required|numeric|digits:6', // OTP
        ]);

        // Check if OTP exists and is valid
        $passwordReset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token) // OTP check
            ->first();
        if (!$passwordReset) {
            return back()->withErrors([
                'token' => __('web.invalid_or_expired_otp'), // Add translation
            ])->withInput(['email' => $request->email]);
        }
        // ✅ OTP Expiration Check (5 minutes)
        if (Carbon::now()->diffInMinutes(Carbon::parse($passwordReset->created_at)) > 5) {
            return redirect()->route('password.request')
            ->withErrors([
                'email' => __('web.otp_expired'),
            ])->withInput(['email' => $request->email]);
        }
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('password.request')
            ->withErrors([
                'email' => __('web.user_not_found'),
            ]);
        }
        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        DB::table('password_resets')->where('email', $request->email)->delete();

        event(new PasswordReset($user));

        return redirect()->route('login')->with('status', __('web.password_reset_success'));
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        // $status = Password::reset(
        //     $request->only('email', 'password', 'password_confirmation', 'token'),
        //     function ($user) use ($request) {
        //         $user->forceFill([
        //             'password' => Hash::make($request->password),
        //             'remember_token' => Str::random(60),
        //         ])->save();

        //         event(new PasswordReset($user));
        //     }
        // );

        // // If the password was successfully reset, we will redirect the user back to
        // // the application's home authenticated view. If there is an error we can
        // // redirect them back to where they came from with their error message.
        // return $status == Password::PASSWORD_RESET
        //             ? redirect()->route('login')->with('status', __($status))
        //             : back()->withInput($request->only('email'))
        //                     ->withErrors(['email' => __($status)]);
    }
}
