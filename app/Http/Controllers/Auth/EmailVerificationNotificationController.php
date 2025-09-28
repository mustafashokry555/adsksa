<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use App\Notifications\SendOtpEmail;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
            ],
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return redirect()
                ->route('register') // Forgot Password route
                ->with(['error' => __('auth.email_not_exist') ]);
        }
        if($user->email_verified_at != null){
            return redirect()
                ->route('login') // Forgot Password route
                ->with(['error' => __('auth.email_is_verified_login') ]);
        }
        // Generate OTP
        $otp = rand(100000, 999999);
        // Store OTP in otps table
        $newRow = Otp::create([
            'email' => $request->email,
            'user_id' => $user->id,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(5),
            'reason' => "Verify Email",
        ]);
        if ($newRow) {
            $user->notify(new SendOtpEmail($otp, 'Virefiy Email OTP', 'an email verification'));
        }
        $email = $request->email;
        return view('auth.confirm-verify-email', compact('email'));
        
    }

    public function verify(Request $request) {
        if (!$request->has('email')) {
            return redirect()
                ->route('verification.email') // Forgot Password route
                ->withErrors(['email' => __('web.email')]);
        }
        
        $request->validate([
            'email' => [
                'required',
                'email',
            ],
            'otp' => 'required|numeric|digits:6',
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return redirect()
                ->route('register') // Forgot Password route
                ->with(['error' => __('auth.email_not_exist') ]);
        }
        if($user->email_verified_at != null){
            return redirect()
                ->route('login') // Forgot Password route
                ->with(['error' => __('auth.email_is_verified_login') ]);
        }

        $otp = Otp::where('email', $request->email)->where('user_id', $user->id)->where('expires_at', '>', now())->where('is_used', 0)
            ->first();
        if (!$otp) {
            return redirect()
                ->route('verification.email')->withErrors([
                'email' => __('web.invalid_or_expired_otp'), // Add translation
            ])->withInput(['email' => $request->email]);
            $otp->delete();
        }
        if ($otp->otp != $request->otp) {
            $email = $request->email;
            return view('auth.confirm-verify-email', compact('email'))->withErrors(['otp' => __('web.invalid_or_expired_otp')]);
        }
        $user->email_verified_at = now();
        $user->save();
        $otp->delete();
        return redirect()
                ->route('login') // Forgot Password route
                ->with(['success' => __('auth.email_verified_success') ]);
    }
}
