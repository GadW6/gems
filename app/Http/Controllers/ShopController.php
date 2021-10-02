<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorie;
use App\Product;
use App\Order;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use DB, Session;


class ShopController extends MainController
{
    public function index(Request $request)
    {
        if (!empty($request['sort']) && !empty($request['order']) && !empty($request['content_search'])) {
            self::$dtv['products'] = Product::getProducts(null, $request['sort'], $request['order'], $request['content_search']);
        } elseif (!empty($request['sort']) || !empty($request['order'])) {
            self::$dtv['products'] = Product::getProducts(null, $request['sort'], $request['order'], null);
        } elseif (!empty($request['content_search'])) {
            self::$dtv['products'] = Product::getProducts(null, null, null, $request['content_search']);
        } else {
            self::$dtv['products'] = Product::paginate(12);
        }
        self::$dtv['page_title'] .= 'Shop';
        self::$dtv['categories'] = Categorie::all();
        self::$dtv['sort'] = $request['sort'];
        self::$dtv['order'] = $request['order'];
        self::$dtv['search'] = $request['content_search'];
        //////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return view('pages.front.shop', self::$dtv);
    }

    public function products(Request $request, $curl)
    {
        if (!empty($request['content_search']) && !empty($request['sort']) && !empty($request['order'])) {
            $products = Product::getProducts($curl, $request['sort'], $request['order'], $request['content_search']);
        } elseif (empty($request['content_search'])) {
            $products = Product::getProducts($curl, $request['sort'], $request['order'], null);
        } elseif (!empty($request['content_search'])) {
            $products = Product::getProducts($curl, null, null, $request['content_search']);
        } else {
            $products = Product::getProducts($curl, null, null, null);
        }
        if (!$products->count()) {
            //////// START DATA MIDDLEWARE
            $server = $request->server->all();
            \App\Request::addNewRecord(404, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
            //////// END DATA MIDDLEWARE
            abort(404);
        }
        self::$dtv['products'] = $products;
        self::$dtv['page_title'] .= $products[0]->c_title;
        self::$dtv['search_title'] = $products[0]->c_title;
        self::$dtv['cat'] = $products[0]->c_url;
        self::$dtv['sort'] = $request['sort'];
        self::$dtv['order'] = $request['order'];
        self::$dtv['search'] = $request['content_search'];
        //////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return view('pages.front.category', self::$dtv);
    }

    public function productDetails($curl, $purl, Request $request)
    {
        $product = Product::where('p_url', '=', $purl)->first();
        $category = Categorie::where('c_url', '=', $curl)->first();
        if (!$product) {
            //////// START DATA MIDDLEWARE
            $server = $request->server->all();
            \App\Request::addNewRecord(404, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
            //////// END DATA MIDDLEWARE
            abort(404);
        }
        self::$dtv['page_title'] .= $product->p_title;
        self::$dtv['product'] = $product;
        self::$dtv['category'] = $category;
        //////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return view('pages.front.detail', self::$dtv);
    }

    static public function addToCart(Request $request)
    {
        Product::addToCart($request['p_id'], $request['category'], $request['qty']);
        //////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return ('success');
    }

    public function cart(Request $request)
    {
        self::$dtv['page_title'] .= 'Cart Page';
        $cart = Cart::getContent()->toArray();
        sort($cart);
        self::$dtv['cart'] = $cart;
        //////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return view('pages.front.cart', self::$dtv);
    }

    public function condition(Request $request)
    {
        if ($request['action']) {
            Cart::removeCartCondition('standard');
            $expressCondition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'express',
                'type' => 'shipping',
                'target' => 'total',
                'value' => '+19',
            ));
            Cart::condition($expressCondition);
            return ('success');
        } else {
            Cart::removeCartCondition('express');
            $standardCondition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'standard',
                'type' => 'shipping',
                'target' => 'total',
                'value' => '+10',
            ));
            Cart::condition($standardCondition);
            return ('success');
        }
    }


    public function removeItem(Request $request)
    {
        Cart::remove($request['pid']);
        //////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return redirect('shop/cart');
    }

    public function updateCart(Request $request)
    {
        Product::updateCart($request);
        //////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return ('success');
    }

    public function postCheckout(Request $request)
    {
        if (Cart::isEmpty()) return redirect('shop/cart');
        Order::saveNew();
        //////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return redirect('/shop/checkout');
    }

    public function checkout(Request $request)
    {
        if (!empty(Session::all()['last_order']) && (Session::all()['last_order']->user_id === Session::all()['user_id'])) {
            $data = unserialize(Session::all()['last_order']->data);
        } else {
            //////// START DATA MIDDLEWARE
            $server = $request->server->all();
            \App\Request::addNewRecord(302, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
            //////// END DATA MIDDLEWARE
            return redirect('/shop/cart');
        }
        self::$dtv['page_title'] .= 'Shop | Checkout';
        self::$dtv['orders'] = array_values($data);
        //////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return view('pages.front.checkout', self::$dtv);
    }
}
