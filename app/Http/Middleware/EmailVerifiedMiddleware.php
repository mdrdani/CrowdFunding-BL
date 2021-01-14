<?php

namespace App\Http\Middleware;

use Closure;

class EmailVerifiedMiddleware
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
        $user = auth()->user();

        if($user->email_verified_at != null) {
            return $next($request);
        }
        
        return response()->json([
            'message' => 'Email anda belum terverifikasi'
        ]);
    }
}