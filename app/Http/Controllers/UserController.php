<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\FullProfileRequest;
use Illuminate\Support\Facades\URL;
use App\User, App\Order;
use Illuminate\Support\Facades\Session;


class UserController extends MainController
{
    public function postRegister(RegisterRequest $request)
    {
        User::saveNew($request);
        //////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return 'Register successful';
    }

    public function postSignin(SigninRequest $request)
    {
        if (User::verify($request['email'], $request['password'])) {
            /////// START DATA MIDDLEWARE
            $server = $request->server->all();
            \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
            //////// END DATA MIDDLEWARE
            return 'Signin successful';
        } else {
            self::$dtv['page_title'] .= 'Signin Page';
            self::$dtv['verify_error'] = 'Wrong email and password';
            /////// START DATA MIDDLEWARE
            $server = $request->server->all();
            \App\Request::addNewRecord(401, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
            //////// END DATA MIDDLEWARE
            return view('signin', self::$dtv);
        }
    }

    public function logout(Request $request)
    {
        Session::forget([
            'user_id',
            'user_name',
            'is_admin'
        ]);
        /////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return 'Logout successful';
    }

    public function profile(Request $request)
    {
        $orders = Order::where('user_id', Session::get('user_id'))->orderBy('created_at', 'desc')->get();
        self::$dtv['page_title'] .= 'Dashboard';
        self::$dtv['orders'] = $orders->toArray();
        self::$dtv['order_total_items'] = Order::getTotalItems($orders->toArray());
        self::$dtv['order_total_sum'] = Order::getTotalSum($orders->toArray());
        self::$dtv['order_status'] = Order::getStatuses($orders->toArray());
        self::$dtv['url'] = URL::current();
        self::$dtv['user'] = User::getFullUser();
        /////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return view('pages.front.profile', self::$dtv);
    }

    public function order(Request $request)
    {
        $orders = Order::where('user_id', Session::get('user_id'))->orderBy('created_at', 'desc')->get();
        self::$dtv['page_title'] .= 'Order History';
        self::$dtv['orders'] = $orders;
        self::$dtv['order_status'] = Order::getStatuses($orders->toArray());
        self::$dtv['url'] = URL::current();
        self::$dtv['user'] = User::where('id', Session::get('user_id'))->first();
        /////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return view('pages.front.order', self::$dtv);
    }

    public function account(Request $request)
    {
        self::$dtv['page_title'] .= 'Account Profile';
        self::$dtv['url'] = URL::current();
        self::$dtv['user'] = User::getFullUser();
        /////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return view('pages.front.account', self::$dtv);
    }

    public function accountPost(FullProfileRequest $request)
    {
        User::saveFullUser(Session::get('user_id'), $request);
        /////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return redirect('/user/profile/account');
    }

    public function invoice($oid, Request $request)
    {
        if (!empty(Order::where('user_id', Session::get('user_id'))->where('id', $oid)->first())) {
            self::$dtv['order'] = Order::where('user_id', Session::get('user_id'))->where('id', $oid)->first();
        }
        self::$dtv['page_title'] .= 'Account Profile';
        self::$dtv['url'] = URL::current();
        self::$dtv['user'] = User::getFullUser();
        self::$dtv['items'] = array_values(unserialize(self::$dtv['order']->data));
        /////// START DATA MIDDLEWARE
        $server = $request->server->all();
        \App\Request::addNewRecord(200, $server['REQUEST_METHOD'], $server['REQUEST_URI']);
        //////// END DATA MIDDLEWARE
        return view('pages.front.invoice', self::$dtv);
    }
}
