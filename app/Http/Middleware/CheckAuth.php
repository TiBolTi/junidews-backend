<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuth
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
        if (Auth::check()) {

        // Пользователь авторизован, продолжаем выполнение запроса
        return $next($request);
    } else {
        // Пользователь не авторизован, возвращаем ошибку 401
        return response('Unauthorized', 401);
    }
        return $next($request);

    }
}
