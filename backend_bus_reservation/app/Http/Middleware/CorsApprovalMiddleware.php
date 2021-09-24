<?php

namespace App\Http\Middleware;

use Closure;

class CorsApprovalMiddleware
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
        header("Access-Control-Allow-Origin: " . env('FRONTEND_DOMAIN_URL'));
        //ALLOW options method
        $headers = [
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, PATCH, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, Accept, X-Auth-Token, Origin, Authorization',
        ];
        if ($request->getMethod() == 'OPTIONS') {
            //The Client-side application can set only headers allowed in Access-Control_Allow-Headers
            return response()->json('OK', 200, $headers);
        }
        $response = $next($request);
        foreach ($headers as $key => $value) {
            $response->headers->set($key, $value);  //$response->header($key, $value); => We can write it this way but ->header() on Response object have no function for binaryfileresponse
        }
        return $response;
    }
}
