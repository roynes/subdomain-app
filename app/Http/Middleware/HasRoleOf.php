<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;

class HasRoleOf
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @param mixed ...$roles
     *
     * @return mixed
     *
     * @throws AuthorizationException
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (! $this->hasRoles($roles)) {
            throw new AuthorizationException('Access Denied.', 403);
        }

        return $next($request);
    }

    protected function hasRoles(array $roles)
    {
        return (bool) auth()->user()->hasRoles($roles);
    }
}
