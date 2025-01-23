<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Affiliate;
use Illuminate\Support\Facades\Session;

class AffiliateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('ad')) {
            $affiliate = Affiliate::where('tracking_code', $request->input('ad'))->first();
            if ($affiliate) {
                $affiliate->increment('visits');
                Session::put('affiliate_id', $affiliate->id);
            }
        }
        return $next($request);
    }
}
