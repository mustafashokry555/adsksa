<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $user = \App\Models\User::where('email', $request->email)->first();
    
        if ($user && $user->status !== 'Active') {
            return back()->withErrors([
                'email' => __('web.account_inactive'),
            ])->withInput($request->except('password'));
        }
        $request->authenticate();

        $request->session()->regenerate();

        if(Auth::user()->is_patient()){
            return redirect()->intended(RouteServiceProvider::DASHBOARD);
        }

        elseif(Auth::user()->is_doctor() || Auth::user()->is_admin() || Auth::user()->is_hospital()){
            return redirect()->intended(RouteServiceProvider::HOME);
        }else{
            abort(401);
        }

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
