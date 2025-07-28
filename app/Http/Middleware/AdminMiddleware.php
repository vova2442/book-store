<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Импортируем фасад для аутентификации
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
        // Проверяем, что пользователь аутентифицирован И его роль - 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Если да, то пропускаем запрос дальше
            return $next($request);
        }

        // Если нет, перенаправляем на главную страницу
        // abort(403) тоже был бы хорошим вариантом, но редирект мягче
        return redirect('/');
    }
}