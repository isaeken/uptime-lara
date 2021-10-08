<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthenticateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $user = User::where('token', $request->bearerToken())->first();
        abort_if($user == null, 403);
        auth()->login($user);
        return $next($request);
    }
}
