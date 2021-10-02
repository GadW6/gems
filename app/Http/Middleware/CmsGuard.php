<?php

namespace App\Http\Middleware;

use Closure, Session, Illuminate\Http\Request;

class CmsGuard
{


    public function handle(Request $request, Closure $next)
    {
        if (!Session::get('is_admin')) {
            //////// START DATA MIDDLEWARE
            $server = $request->server->all();
            \App\Request::addNewRecord(401, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
            //////// END DATA MIDDLEWARE
            return redirect('/');
        }
        return $next($request);
    }
}
