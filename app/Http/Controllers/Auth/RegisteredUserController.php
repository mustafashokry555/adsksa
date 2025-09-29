<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Otp;
use App\Models\Religion;
use App\Models\User;
use App\Notifications\SendOtpEmail;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $religions = Religion::all();
        return view('auth.register', compact('religions'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'gender' => 'nullable|string|in:M,F',
            'date_of_birth' => 'nullable|date|before:today',
            'id_number' => ['required', 'string', 'max:50', 'unique:users'],
            'nationality' => ['required', 'exists:religions,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'digits:10', 'regex:/^0[0-9]{9}$/'],
            'password' => ['required', 'confirmed', Password::min(6)->mixedCase()],
        ],[
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password must be at least :min characters.',
            'password.mixed' => 'The password must contain at least one uppercase and one lowercase letter.',
        ]);

        $user = User::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'gender' => $request->grnder,
            'date_of_birth' => $request->date_of_birth,
            'id_number' => $request->id_number,
            'religion_id' => $request->nationality,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'user_type' => "U",
        ]);

        if($user){
            event(new Registered($user));
            // // Generate OTP
            // $otp = rand(100000, 999999);
            // // Store OTP in otps table
            // $newRow = Otp::create([
            //     'user_id ' => $otp,
            //     'email ' => $request->email,
            //     'otp' => $otp,
            //     'expires_at' => now()->addMinutes(5),
            //     'reason' => "Verify Email",
            // ]);
            // if ($newRow) {
            //     $user->notify(new SendOtpEmail($otp, 'Virefiy Email OTP', 'an email verification'));
            // }

            return view('auth.verify-email');
        }

        // Auth::login($user);
        // dd(Auth::user());
        
        // if(Auth::user()->user_type=='U'){
            // return redirect(RouteServiceProvider::DASHBOARD);
        // }

        // return redirect(RouteServiceProvider::HOME);
    }
}
