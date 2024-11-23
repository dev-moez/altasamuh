<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Session\Middleware\StartSession as BaseStartSession;


class StartSession extends BaseStartSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, \Closure $next)   

    {
        if (!$request->hasCookie(config('session.cookie'))) {
            $request->session()->regenerate(true);
        }

        return parent::handle($request, $next); 
    }
}
