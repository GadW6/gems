<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;

class PagesController extends MainController
{
    public function home(Request $request)
    {
        self::$dtv['page_title'] .= 'Home Page';

        //////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE

        return view('pages.front.home', self::$dtv);
    }

    public function content($menu_url, Request $request)
    {
        $content = Content::getAll($menu_url);
        if (!$content->count()) {
            //////// START DATA MIDDLEWARE
            $server = $request->server->all();
            \App\Request::addNewRecord(404, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
            //////// END DATA MIDDLEWARE
            abort(404);
        }
        self::$dtv['contents'] = $content->toArray();
        // dd(self::$dtv['menu']->where('url', $menu_url)->first());
        self::$dtv['page_title'] .= self::$dtv['menu']->where('url', $menu_url)->first()->title;
        //////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return view('pages.front.menu', self::$dtv);
    }
}
