<?php

namespace App\Http\Middleware;

use Closure;

use \Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if(is_null($user))
            return redirect('/login')->with('error', 'Yetkisiz işlem! Sisteme giriş yapınız');
        if ($user->hasRole('Customer')) {
            return redirect('/home')->with('error', 'Yetkisiz işlem! Bu işlem yönetici yetkileri gerektirir');
        }
        return $next($request);
    }
}
