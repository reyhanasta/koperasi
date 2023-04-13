<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogCrudActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $user = $request->user();
        $ip = $request->ip();
        $method = $request->method();
        $url = $request->fullUrl();
        $route = $request->route()->getName();
        $inputdata = json_encode($request->all());
        $statuscode = $response->getStatusCode();

        $message = "User '{$user->username}' (id:{$user->id}) performed a CRUD operation at $url ($method) with data $inputdata from IP $ip. Route: $route. Response status code: $statuscode";
        Log::info($message);

        return $response;
    }
}