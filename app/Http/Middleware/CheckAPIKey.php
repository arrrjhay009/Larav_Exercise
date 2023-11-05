<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAPIKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $APIKey = $request->header('api-key');

        if ($APIKey && $APIKey === 'your-api-key') {
            return $next($request);
        }

        return response() -> json(['message' => 'Unauthorized'], 401);
    }
}
