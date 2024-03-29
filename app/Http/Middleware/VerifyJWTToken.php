<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJWTToken{

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next)
    : Response{
        try{
            $user = JWTAuth::toUser($request->input('token'));
        }catch (JWTException $e){
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['token_expired'], $e->getStatusCode());
            }elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['token_invalid'], $e->getStatusCode());
            }else{
                return response()->json(['error' => 'Token is required']);
            }
        }

        return $next($request);
    }
}
