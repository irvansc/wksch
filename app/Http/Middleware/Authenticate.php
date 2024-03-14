<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // return $request->expectsJson() ? null : route('login');
        if (! $request->expectsJson()) {
            // return route('login');

            if ($request->routeIs('admin.*')) {
                session()->flash('fail', 'You must sign first!');
                return route('admin.login',['fail'=> true,'returnUrl'=>URL::current()]);
            }
        }
    }
}
