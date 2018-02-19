<?php

namespace Bantenprov\GroupEgovernment\Http\Middleware;

use Closure;

/**
 * The GroupEgovernmentMiddleware class.
 *
 * @package Bantenprov\GroupEgovernment
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class GroupEgovernmentMiddleware
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
        return $next($request);
    }
}
