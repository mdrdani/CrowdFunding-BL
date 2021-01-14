<?php

namespace App\Http\Middleware;

use Closure;
<<<<<<< HEAD
use PDO;
=======
use Illuminate\Support\Facades\Auth;
>>>>>>> 11b5dd8d4a23d9fd44b9ef3d6cf811be9ea35985

class AdminMiddleware
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
<<<<<<< HEAD
        $user = auth()->user();

        if($user->isAdmin()){
            return $next($request);
        }

        return response()->json([
            'message' => 'Anda Bukan Admin'
        ]);
=======
        if(Auth::user()->isAdmin()){
            return $next($request);
        }
        abort(403);
>>>>>>> 11b5dd8d4a23d9fd44b9ef3d6cf811be9ea35985
    }
}