<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceJsonApi
{
    public function handle(Request $request, Closure $next)
    {
        // Force Accept header
        $request->headers->set('Accept', 'application/json');

        // Force Content-Type for POST/PUT/PATCH
        if (in_array($request->method(), ['POST', 'PUT', 'PATCH'])) {
            $request->headers->set('Content-Type', 'application/json');
        }

        return $next($request);
    }
}
