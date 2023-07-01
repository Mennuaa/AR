<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        dd(auth()->user());
        if(auth()->user() == null){
            return redirect('/');
        }
        if(auth()->user()->role_id !== 4){
            return response([
                'success' => false,
                'message' => 'dont have access'
            ]);
        }
        return $next($request);
    }
}
