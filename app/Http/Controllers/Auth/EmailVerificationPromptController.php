<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function index()
    {
        return view('web.auth.verify-email');
        // return $request->user()->hasVerifiedEmail()
        //     ? redirect()->intended(RouteServiceProvider::HOME)
        //     : view('auth.verify-email');
    }
}
