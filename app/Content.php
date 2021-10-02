<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB, Session;

class Content extends Model
{
    static public function getAll($menu_url)
    {
        return DB::table('contents as c')
            ->join('menus as m', 'm.id', '=', 'c.menu_id')
            ->where('m.url', '=', $menu_url)
            ->select('m.title', 'c.c_title', 'c.c_article')
            ->get();
    }


    static public function saveNew($request)
    {
        $content = new self();
        $content->menu_id = $request['menu'];
        $content->ctitle = $request['title'];
        $content->carticle = $request['article'];
        $content->save();
        Session::flash('sm', 'Content Saved');
    }

    static public function updateItem($request, $id)
    {
        $content = self::find($id);
        $content->menu_id = $request['menu'];
        $content->ctitle = $request['title'];
        $content->carticle = $request['article'];
        $content->save();
        Session::flash('sm', 'Content Updated');
    }
}
