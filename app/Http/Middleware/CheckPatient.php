<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

class CheckPatient
{
    use ApiResponser;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->user_type == User::PATIENT){

            return $next($request);
        }else{
            return $this->ErrorResponse(422, trans('auth.user_type_fail'));
            // response()->json(['message'=>'You are not authorized for this route.',"status"=>400,"data"=>null]);
        }
    }
}
