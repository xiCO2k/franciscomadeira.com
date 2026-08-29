<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureStripPublisherToken
{
    public function handle(Request $request, Closure $next): Response|JsonResponse
    {
        $expected = (string) config('strip.publisher_token');
        $provided = $request->bearerToken();

        if ($expected === '') {
            return response()->json(['message' => 'Release publishing is disabled.'], 503);
        }

        if ($provided === null || ! hash_equals($expected, $provided)) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        return $next($request);
    }
}
