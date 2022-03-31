<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class userBaned
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
        if(Auth::check() && Auth::user()->isban){
            $banned=Auth::user()->isban=='1';
            Auth::logout();
            if($banned==1){
                $message="আপনার অ্যাকাউন্টটি বন্ধ রাখা হয়েছে .দয়া করে কতৃপক্ষের সাথে যোগাযোগ করুন";
            }
            return redirect()->route('login')->with('status',$message)->withErrors(['status'=>"আপনার অ্যাকাউন্টটি বন্ধ রাখা হয়েছে .দয়া করে কতৃপক্ষের সাথে যোগাযোগ করুন"]);
        }
        return $next($request);
    }
}
