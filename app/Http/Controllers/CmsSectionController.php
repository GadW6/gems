<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContentRequest;
use Illuminate\Support\Facades\Session;
use App\User, App\Content, App\Menu;

class CmsSectionController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$dtv['page_title'] .= 'CMS Contents';
        self::$dtv['title'] = 'Create Sections';
        self::$dtv['user'] = User::where('id', Session::get('user_id'))->first();
        return view('pages.back.section_create', self::$dtv);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentRequest $request, $id)
    {
        $section = new Content;
        $section->menu_id = $id;
        $section->c_title = $request['title'];
        $section->c_article = $request['article'];
        $section->save();
        Session::flash('sm', 'Your changes were made successfully');
        return redirect('cms/contents/' . $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($first, $second)
    {
        self::$dtv['page_title'] .= 'CMS Contents';
        self::$dtv['title'] = 'Create Sections';
        self::$dtv['user'] = User::where('id', Session::get('user_id'))->first();
        self::$dtv['section'] = Content::where('id', $second)->first();
        return view('pages.back.section_edit', self::$dtv);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContentRequest $request, $first, $second)
    {
        $section = Content::find($second);
        $section->menu_id = $first;
        $section->c_title = $request['title'];
        $section->c_article = $request['article'];
        $section->save();
        Session::flash('sm', 'Your changes were made successfully');
        return redirect('cms/contents/' . $first);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($first, $second)
    {
        $section = Content::find($second);
        $section->delete();
        echo 'success';
        return Session::flash('sm', 'Your changes were made successfully');
    }
}
