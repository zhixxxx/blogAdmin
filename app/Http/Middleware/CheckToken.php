<?php

namespace App\Http\Middleware;

use App\Exceptions\CheckTokenException;
use Closure;

class CheckToken
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
        $Token = $request->header('admin_token', '');

        if (!$Token) {
            throw new CheckTokenException();
        }

        return $next($request);
    }
}
