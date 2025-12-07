<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $nonce = base64_encode(random_bytes(16));
        
        $response->headers->set('Content-Security-Policy', "script-src 'self' 'nonce-$nonce'");
        // Share the nonce with all views
        view()->share('nonce', $nonce);

        return $response;
    }
}
