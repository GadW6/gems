<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Session;

class SessionData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    static private function getRealIPAddr($server)
    {
        //check ip from share internet
        if (!empty($server['HTTP_CLIENT_IP'])) {
            $ip = $server['HTTP_CLIENT_IP'];
        }
        //to check ip is pass from proxy
        elseif (!empty($server['HTTP_X_FORWARDED_FOR'])) {
            $ip = $server['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $server['REMOTE_ADDR'];
        }

        return $ip;
    }

    public function handle($request, Closure $next)
    {
        if (!Session::has('REMOTE_ADDR') && !Session::has('device') && !Session::has('browser')) {
            $agent = new Agent();
            $device = (($agent->isDesktop()) ? 'desktop' : 'mobile');
            $browser = $agent->browser();

            Session::put('REMOTE_ADDR', (self::getRealIPAddr($request->server->all()) == ', ') ? 'Home' : self::getRealIPAddr($request->server->all()));
            Session::put('device', $device);
            Session::put('browser', $browser);
        }

        return $next($request);
    }
}
