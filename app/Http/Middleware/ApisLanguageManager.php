<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App;

class ApisLanguageManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->header('lang', 'en');

        // Set the application locale
        App::setLocale($locale);

        return $next($request);
    }
}
