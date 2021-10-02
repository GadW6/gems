<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User, App\Categorie, App\Product;
use Illuminate\Support\Facades\Session;

class CmsInventoryProductController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        self::$dtv['page_title'] .= 'CMS Inventory';
        self::$dtv['title'] = 'Site Inventory';
        self::$dtv['user'] = User::where('id', Session::get('user_id'))->first();
        self::$dtv['category'] = Categorie::where('id', $id)->first();
        return view('pages.back.product_create', self::$dtv);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, $id)
    // public function store(Request $request, $id)
    {
        $image = $request['image'];
        $validatedUri = $request->validate([
            'uri' => 'required|min:2|max:255|regex:/^[a-z\d-]+$/|unique:products,p_url',
            'image' => 'required|file|max:512|image',
        ]);

        $product = new Product;
        $product->category_id = $id;
        $product->p_title = $request['title'];
        $product->p_article = $request['description'];
        if ($image && $image->isValid()) {
            $product->p_image = $image->getClientOriginalName();
            $request->image->storeAs(Categorie::where('id', $id)->first()->c_url, $image->getClientOriginalName(), 'public');
        }
        $product->p_price = $request['price'];
        $product->p_url = $validatedUri['uri'];
        $product->save();

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
    public function edit($cid, $pid)
    {
        self::$dtv['page_title'] .= 'CMS Inventory';
        self::$dtv['title'] = 'Site Inventory';
        self::$dtv['user'] = User::where('id', Session::get('user_id'))->first();
        self::$dtv['category'] = Categorie::where('id', $cid)->first();
        self::$dtv['product'] = Product::where('id', $pid)->first();
        return view('pages.back.product_edit', self::$dtv);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $cid, $pid)
    {
        $image = $request['image'];
        $validatedUri = $request->validate([
            'uri' => 'required|min:2|max:255|regex:/^[a-z\d-]+$/|unique:products,p_url,' . $pid,
            'image' => 'file|max:512|image',
        ]);

        $product = Product::find($pid);
        $product->category_id = $cid;
        $product->p_title = $request['title'];
        $product->p_article = $request['description'];
        if ($image && $image->isValid()) {
            $oldProd = $product->p_image;
            $product->p_image = $image->getClientOriginalName();
            $request->image->storeAs(Categorie::where('id', $cid)->first()->c_url, $image->getClientOriginalName(), 'public');
            if (Storage::exists('public/' . Categorie::where('id', $cid)->first()->c_url . '/' . $oldProd)) {
                Storage::delete('public/' . Categorie::where('id', $cid)->first()->c_url . '/' . $oldProd);
            }
        }
        $product->p_price = $request['price'];
        $product->p_url = $validatedUri['uri'];
        $product->save();
        Session::flash('sm', 'Your changes were made successfully');
        return redirect('cms/inventory');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cid, $pid)
    {
        $product = Product::find($pid);
        if (Storage::exists('public/', Categorie::where('id', $cid)->first()->c_url . '/' . $product->p_image)) {
            Storage::delete('public/', Categorie::where('id', $cid)->first()->c_url . '/' . $product->p_image);
        }
        $product->delete();
        echo 'success';
        return Session::flash('sm', 'Your changes were made successfully');
    }
}
