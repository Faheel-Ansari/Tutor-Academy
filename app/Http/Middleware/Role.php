<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $userRole = $request->user()->role;
        if ($userRole !== $role) {
            if ($userRole === 'admin') {
                return redirect('/admin/dashboard');
            }
            if ($userRole === 'teacher') {
                return redirect('/teacher/dashboard');
            }
            if ($userRole === 'student') {
                return redirect('/student/dashboard');
            }
            return redirect('/login');
        }
        return $next($request);
    }
}
