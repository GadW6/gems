<?php

namespace App\Http\Middleware;

use Closure, Session;

class UserNotAuth
{
    public function handle($request, Closure $next)
    {
        if (Session::has('user_id')) {
            //////// START DATA MIDDLEWARE
            $server = $request->server->all();
            \App\Request::addNewRecord(302, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
            //////// END DATA MIDDLEWARE
            return redirect('');
        }
        return $next($request);
    }
}
