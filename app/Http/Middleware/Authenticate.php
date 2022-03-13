<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        $routePrevius = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
        $routeHasAdmin = strpos($routePrevius, 'admin') === 0 ? true : false;
        if (!$request->expectsJson()) {
            if ($routeHasAdmin) {
                return route('admin.login');
            }
            return route('user.login');
        }
    }
}
