<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User, App\Content, App\Menu;
use App\Http\Requests\MenuRequest;

class CmsContentController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$dtv['page_title'] .= 'CMS Contents';
        self::$dtv['title'] = 'Site Contents';
        self::$dtv['user'] = User::where('id', Session::get('user_id'))->first();
        self::$dtv['content'] = Content::all();

        return view('pages.back.contents', self::$dtv);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$dtv['page_title'] .= 'CMS Contents';
        self::$dtv['title'] = 'Site Contents';
        self::$dtv['user'] = User::where('id', Session::get('user_id'))->first();
        self::$dtv['content'] = Content::all();

        return view('pages.back.contents_create', self::$dtv);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $menu = new Menu;
        $menu->link = $request['title'];
        $menu->url = $request['uri'];
        $menu->title = $request['section-title'];
        $menu->save();
        Session::flash('sm', 'Your changes were made successfully');
        return redirect('cms/contents');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($menu_id)
    {
        $contentAll = Content::all();
        self::$dtv['page_title'] .= 'CMS Contents';
        self::$dtv['title'] = 'CMS | ' . Menu::where('id', $menu_id)->first()->link;
        self::$dtv['user'] = User::where('id', Session::get('user_id'))->first();
        self::$dtv['content'] = $contentAll->where('menu_id', $menu_id)->toArray();
        return view('pages.back.sections', self::$dtv);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        self::$dtv['page_title'] .= 'CMS Contents';
        self::$dtv['title'] = 'Site Contents';
        self::$dtv['user'] = User::where('id', Session::get('user_id'))->first();
        self::$dtv['menu'] = self::$dtv['menu']->where('id', $id)->first();
        return view('pages.back.contents_edit', self::$dtv);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        $menu = Menu::find($id);
        $menu->link = $request['title'];
        $menu->url = $request['uri'];
        $menu->title = $request['section-title'];
        $menu->save();
        Session::flash('sm', 'Your changes were made successfully');
        return redirect('cms/contents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        echo 'success';
        Session::flash('sm', 'Your changes were made successfully');
    }
}
