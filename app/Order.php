<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cart, Session, DB, App\User;


class Order extends Model
{
    static public function saveNew()
    {
        $order = new self();
        $order->user_id = Session::get('user_id');
        $order->data = serialize(Cart::getContent()->toArray());
        // dd(array_keys(Cart::getConditions()->toArray())[0]);
        // $order->shipping = array_keys(Session::all()['condition']->toArray())[0];
        $order->shipping = array_keys(Cart::getConditions()->toArray())[0];
        $order->total = Cart::getTotal();
        $order->save();
        Session::put([
            'last_order' => self::getByUid(Session::get('user_id'))->first(),
            'condition' => Cart::getConditions(),
        ]);
        Cart::clear();
        Session::flash('sm', 'You order is saved!');
    }

    static public function getByUid($uid)
    {
        return DB::table('orders')->select('*')->where('user_id', $uid)->orderBy('created_at', 'desc')->get();
    }

    static public function getByOid($oid)
    {
        return DB::table('orders')->select('*')->where('id', $oid)->first();
    }

    static public function getTotalItems($arr)
    {
        $cleanArray = function ($order) {
            $insides = (array_values(unserialize($order['data'])));
            $insideArray = function ($inside) {
                return ((int) $inside['quantity']);
            };
            $insideArr = array_map($insideArray, $insides);
            return array_sum($insideArr);
        };
        $cleanArr = array_map($cleanArray, $arr);
        return array_sum($cleanArr);
    }

    static public function getTotalSum($arr)
    {
        $cleanArray = function ($order) {
            return ((int) $order['total']);
        };
        $cleanArr = array_map($cleanArray, $arr);
        return array_sum($cleanArr);
    }

    static public function getStatuses($arr)
    {
        $cleanArray = function ($order) {
            $dbTime = strtotime($order['created_at']);
            $back24h = time() - (24 * 60 * 60);
            $back6h = time() - (6 * 60 * 60);
            if ($dbTime < $back24h) {
                return 1;
            } elseif ($dbTime < $back6h) {
                return 2;
            } else {
                return 3;
            }
        };
        return array_map($cleanArray, $arr);
    }

    static public function getAll()
    {
        return DB::table('orders as o')->join('users as u', 'u.id', '=', 'o.user_id')
            ->select('u.name', 'o.*')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
