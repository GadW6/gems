<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\DB, Illuminate\Support\Facades\Session, FileManager;


class Product extends Model
{
    static public function getProducts($curl, $sort, $order, $search)
    {
        $sort = (empty($sort) ? 'p_price' : $sort);
        $order = (empty($order) ? 'asc' : $order);

        if (empty($curl)) {
            return DB::table('products as p')
                ->join('categories as c', 'c.id', '=', 'p.category_id')
                ->select('p.*', 'c.c_title', 'c.c_url')
                ->where('p_title', 'like', '%' . $search . '%')
                ->orderBy('p.' . $sort, $order)
                ->paginate(12);
        }
        if (!empty($search)) {
            return DB::table('products as p')
                ->join('categories as c', 'c.id', '=', 'p.category_id')
                ->select('p.*', 'c.c_title', 'c.c_url')
                ->where('c.c_url', '=', $curl)
                ->where('p_title', 'like', '%' . $search . '%')
                ->orderBy('p.' . $sort, $order)
                ->paginate(12);
        }
        return DB::table('products as p')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->select('p.*', 'c.c_title', 'c.c_url')
            ->where('c.c_url', '=', $curl)
            ->orderBy('p.' . $sort, $order)
            ->paginate(12);
        // ->get();
    }

    static public function addToCart($pid, $category, $qty)
    {
        if (is_numeric($pid) && $product = self::find($pid)) {
            $standardCondition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'standard',
                'type' => 'shipping',
                'target' => 'total',
                'value' => '+10',
            ));
            Cart::condition($standardCondition);
            if (!$qty) {
                Cart::add($pid, $product->p_title, $product->p_price, 1, ['category' => $category, 'url' => $product->p_url, 'image' => $product->p_image]);
            } else {
                Cart::add($pid, $product->p_title, $product->p_price, $qty, ['category' => $category, 'url' => $product->p_url, 'image' => $product->p_image]);
            }
            Session::flash('sm', ucfirst($product->p_title) . ' has been added to Cart');
        }
    }


    static public function updateCart($request)
    {
        if (!empty($request['pid']) && is_numeric($request['pid'])) {
            if ($request['op'] == 'plus') {
                Cart::update($request['pid'], ['quantity' => +1]);
            } else if ($request['op'] == 'minus') {
                Cart::update($request['pid'], ['quantity' => -1]);
            }
        }
    }

    static public function saveNew($request)
    {
        $product = new self();
        $product->categorie_id = $request['category'];
        $product->ptitle = $request['title'];
        $product->particle = $request['description'];
        $product->pimage = FileManager::loadImage($request);
        $product->price = $request['price'];
        $product->purl = $request['url'];
        $product->save();
        Session::flash('sm', 'Product Saved');
    }

    static public function updateItem($request, $id)
    {
        $product = self::find($id);
        $product->categorie_id = $request['category'];
        $product->ptitle = $request['title'];
        $product->particle = $request['description'];
        $product->pimage = FileManager::loadImage($request, $product->pimage);
        $product->price = $request['price'];
        $product->purl = $request['url'];
        $product->save();
        Session::flash('sm', 'Product Updated');
    }

    static public function getByCategory($id)
    {
        self::where('category_id', $id)->orderBy('id')->get();
    }
}
