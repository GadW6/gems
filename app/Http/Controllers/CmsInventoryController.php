<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User, App\Categorie, App\Product;
use Illuminate\Support\Facades\Session;

class CmsInventoryController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$dtv['page_title'] .= 'CMS Inventory';
        self::$dtv['title'] = 'Site Inventory';
        self::$dtv['user'] = User::where('id', Session::get('user_id'))->first();
        self::$dtv['categories'] = Categorie::all();
        self::$dtv['products'] = Product::all();
        return view('pages.back.inventory', self::$dtv);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$dtv['page_title'] .= 'CMS Inventory';
        self::$dtv['title'] = 'Site Inventory';
        self::$dtv['user'] = User::where('id', Session::get('user_id'))->first();
        return view('pages.back.inventory_create', self::$dtv);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $image = $request['image'];
        $validatedUri = $request->validate([
            'uri' => 'required|min:2|max:255|regex:/^[a-z\d-]+$/|unique:categories,c_url',
            'image' => 'required|file|max:512|image',
        ]);

        $category = new Categorie;
        $category->c_title = ucfirst($request['title']);
        $category->c_url = strtolower($validatedUri['uri']);
        if ($request['description']) {
            $category->c_description = $request['description'];
        }
        if ($image && $image->isValid()) {
            $category->c_image = $image->getClientOriginalName();
            $request->image->storeAs('categories', $image->getClientOriginalName(), 'public');
        }
        Storage::makeDirectory('public/' . strtolower($validatedUri['uri']));
        $category->save();
        Session::flash('sm', 'Your changes were made successfully');
        return redirect('cms/inventory');
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
    public function edit($id)
    {
        self::$dtv['page_title'] .= 'CMS Inventory';
        self::$dtv['title'] = 'Site Inventory';
        self::$dtv['user'] = User::where('id', Session::get('user_id'))->first();
        self::$dtv['category'] = Categorie::where('id', $id)->first();
        return view('pages.back.inventory_edit', self::$dtv);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $validatedUri = $request->validate([
            'uri' => 'required|min:2|max:255|regex:/^[a-z\d-]+$/|unique:categories,c_url,' . $id,
            'image' => 'file|max:512|image',
        ]);
        $image = $request['image'];

        $category = Categorie::find($id);

        // Storing old URI naming
        $oldUri = $category->c_url;

        $category->c_title = $request['title'];
        $category->c_url = strtolower($validatedUri['uri']);
        if ($request['description']) {
            $category->c_description = $request['description'];
        }
        if ($image && $image->isValid()) {
            $oldCat = $category->c_image;
            $category->c_image = $image->getClientOriginalName();
            $request->image->storeAs('categories', $image->getClientOriginalName(), 'public');
            if (Storage::exists('public/categories/' . $oldCat)) {
                Storage::delete('public/categories/' . $oldCat);
            }
        }
        if ($category->c_url != $oldUri) {
            Storage::move('public/' . $oldUri, 'public/' . $category->c_url);
        }
        $category->save();
        Session::flash('sm', 'Your changes were made successfully');
        return redirect('cms/inventory');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categorie::find($id);
        if (Storage::exists('public/categories/' . $category->c_image)) {
            Storage::delete('public/categories/' . $category->c_image);
        }
        if (!Product::where('category_id', $id)->count()) {
            Storage::deleteDirectory('public/' . $category->c_url);
        }
        $category->delete();
        echo 'success';
        return Session::flash('sm', 'Your changes were made successfully');
    }
}
