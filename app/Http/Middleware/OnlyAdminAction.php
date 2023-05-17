<?php

namespace App\Http\Middleware;

use App\Exceptions\NotAnAdminException;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdminAction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $adminRole = Role::where('name', 'admin')->first();
        if ($user->role_id != $adminRole->id) {
            throw new NotAnAdminException();
        }
        return $next($request);
    }
}
