<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

# CMS prefix
Route::middleware(['cmsguard'])->group(function () {
    Route::prefix('cms')->group(function () {
        Route::get('/', 'CmsController@dashboard');
        Route::resource('contents', 'CmsContentController');
        Route::resource('contents.sections', 'CmsSectionController');
        Route::resource('inventory', 'CmsInventoryController');
        Route::resource('inventory.product', 'CmsInventoryProductController');
        Route::get('/orders', 'CmsController@orders');
    });
});


# shop prefix
Route::prefix('shop')->group(function () {
    Route::get('/', 'ShopController@index');
    Route::get('checkout', 'ShopController@checkout')->middleware('userauth');
    Route::post('checkout', 'ShopController@postCheckout')->middleware('userauth');
    Route::get('update-cart', 'ShopController@updateCart');
    Route::get('cart', 'ShopController@cart');
    Route::get('cart/condition', 'ShopController@condition');
    Route::get('add-to-cart', 'ShopController@addToCart');
    Route::get('remove', 'ShopController@removeItem');
    Route::get('{curl}', 'ShopController@products');
    Route::get('{curl}/{purl}', 'ShopController@productDetails');
});

# User prefix
Route::prefix('user')->group(function () {
    Route::post('register', 'UserController@postRegister')->middleware('notauth');
    Route::post('signin', 'UserController@postSignin')->middleware('notauth');
    Route::get('logout', 'UserController@logout')->middleware('userauth');
    Route::middleware(['userauth'])->group(function () {
        Route::prefix('profile')->group(function () {
            Route::get('/', 'UserController@profile');
            Route::get('order', 'UserController@order');
            Route::get('order/{oid}', 'UserController@invoice');
            Route::get('account', 'UserController@account');
            Route::post('account', 'UserController@accountPost');
        });
    });
});


Route::prefix('/')->group(function () {
    Route::get('', 'PagesController@home');
    # Pages Controller
    Route::get('{menu_url}', 'PagesController@content');
});

# Fallback Route (catch-all)
Route::fallback(function (Request $request) {
    //////// START DATA MIDDLEWARE
    $server = $request->server->all();
    \App\Request::addNewRecord(404, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
    //////// END DATA MIDDLEWARE
    return view('errors.404');
});
