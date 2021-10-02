<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content, App\Order, App\User, App\Product, Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Request as SessionReq;

class CmsController extends MainController
{
    static private function avgCalc($arr)
    {
        $cleanArray = function ($log) {
            return ((int) $log['time']);
        };
        $cleanArr = array_map($cleanArray, $arr->toArray());
        return (int)((array_sum($cleanArr)) / $arr->count());
    }

    static private function mapRoutes($arr)
    {
        $changedArray = function ($log) {
            if (preg_match('/^\/user\/profile\/order\/\d+$/', $log['uri'])) {
                return '/user/profile/order/*';
            } elseif (strpos($log['uri'], '?')) {
                return explode('?', $log['uri'])[0];
            } else {
                return $log['uri'];
            }
        };
        return array_count_values(array_map($changedArray, $arr->where('status', 200)->toArray()));
    }

    static public function monthlyOrderCount($orders)
    {
        return array(
            $orders->where('created_at', '<', gmdate('Y-m-01 00:00:00', (int)strtotime('-1 month', time()) - 2))->where('created_at', '>', gmdate('Y-m-01 00:00:00', (int)strtotime('-1 month', time()) - 3))->count(),
            $orders->where('created_at', '<', gmdate('Y-m-01 00:00:00', (int)strtotime('-1 month', time()) - 1))->where('created_at', '>', gmdate('Y-m-01 00:00:00', (int)strtotime('-1 month', time()) - 2))->count(),
            $orders->where('created_at', '<', date('Y-m-01 00:00:00'))->where('created_at', '>', gmdate('Y-m-01 00:00:00', (int)strtotime('-1 month', time()) - 1))->count(),
            $orders->where('created_at', '>', date('Y-m-01 00:00:00'))->count(),
        );
    }

    static private function itemCount($arr)
    {
        $cleanArray = function ($order) {
            $child = unserialize($order['data']);
            $childArr = function ($each) {
                return ($each['quantity']);
            };
            $result = array_map($childArr, $child);
            return array_sum($result);
        };
        $result = array_map($cleanArray, $arr->toArray());
        return array_sum($result);
    }

    static private function monthlyItemCount($orders)
    {
        return array(
            self::itemCount($orders->where('created_at', '<', gmdate('Y-m-01 00:00:00', (int)strtotime('-1 month', time()) - 2))->where('created_at', '>', gmdate('Y-m-01 00:00:00', (int)strtotime('-1 month', time()) - 3))),
            self::itemCount($orders->where('created_at', '<', gmdate('Y-m-01 00:00:00', (int)strtotime('-1 month', time()) - 1))->where('created_at', '>', gmdate('Y-m-01 00:00:00', (int)strtotime('-1 month', time()) - 2))),
            self::itemCount($orders->where('created_at', '<', date('Y-m-01 00:00:00'))->where('created_at', '>', gmdate('Y-m-01 00:00:00', (int)strtotime('-1 month', time()) - 1))),
            self::itemCount($orders->where('created_at', '>', date('Y-m-01 00:00:00'))),
        );
    }

    static private function requestsCount($requests)
    {
        $interval = 30;
        $period = 2 * 24;
        $arr = [];
        for ($i = $period; $i > 0; $i--) {
            if ($i === 1) {
                $query = $requests->where('created_at', '>', gmdate('Y-m-d H:i:00', (int)strtotime('-' . $interval . ' min', time())));
                array_push($arr, [
                    200 => $query->where('status', 200)->count(),
                    401 => $query->where('status', 401)->count(),
                    404 => $query->where('status', 404)->count(),
                ]);
            } else {
                $query = $requests->where('created_at', '>', gmdate('Y-m-d H:i:00', (int)strtotime('-' . ($interval * $i) . ' min', time())))->where('created_at', '<=', gmdate('Y-m-d H:i:00', (int)strtotime('-' . ($interval * ($i - 1)) . ' min', time())));
                array_push($arr, [
                    200 => $query->where('status', 200)->count(),
                    401 => $query->where('status', 401)->count(),
                    404 => $query->where('status', 404)->count(),
                ]);
            }
        }
        return $arr;
    }

    static private function requestsMapping($arr, $status)
    {
        if ($status === 200) {
            return array_map(function ($request) {
                return ($request[200]);
            }, $arr);
        }
        if ($status === 401) {
            return array_map(function ($request) {
                return ($request[401]);
            }, $arr);
        }
        if ($status === 404) {
            return array_map(function ($request) {
                return ($request[404]);
            }, $arr);
        }
    }

    public function dashboard()
    {
        $logs = SessionReq::all();
        $orders = Order::all();
        $users = User::all();
        self::$dtv['page_title'] .= 'CMS Dashboard';
        self::$dtv['title'] = 'Dashboard';
        self::$dtv['logs'] = $logs;
        self::$dtv['routes'] = self::mapRoutes($logs);
        self::$dtv['users'] = $users;
        self::$dtv['user'] = $users->where('id', Session::get('user_id'))->first();
        self::$dtv['orders'] = $orders;
        self::$dtv['monthlyOrderCount'] = self::monthlyOrderCount($orders);
        self::$dtv['monthlyItemCount'] = self::monthlyItemCount($orders);
        self::$dtv['requestsCount200'] = self::requestsMapping(self::requestsCount($logs), 200);
        self::$dtv['requestsCount401'] = self::requestsMapping(self::requestsCount($logs), 401);
        self::$dtv['requestsCount404'] = self::requestsMapping(self::requestsCount($logs), 404);
        self::$dtv['geos'] = $logs->pluck('geo')->countBy()->toArray();
        self::$dtv['mobileVsDesktop'] = [$logs->where('device', 'desktop')->count(), $logs->where('device', 'mobile')->count()];
        self::$dtv['todayAvg'] = self::avgCalc($logs->where('created_at', '>', gmdate('Y-m-d H:i:s', strtotime('-24 hours', time()))));
        self::$dtv['monthAvg'] = self::avgCalc($logs->where('created_at', '>', gmdate('Y-m-d H:i:s', strtotime('-30 days', time()))));
        self::$dtv['products'] = Product::all();
        self::$dtv['roles'] = DB::table('user_roles')->select('*')->get();
        return view('pages.back.dashboard', self::$dtv);
    }

    public function orders()
    {
        $users = User::all();
        $orders = Order::all();

        self::$dtv['page_title'] .= 'CMS Order';
        self::$dtv['title'] = 'Orders';
        self::$dtv['user'] = $users->where('id', Session::get('user_id'))->first();
        self::$dtv['orders'] = $orders;
        self::$dtv['users'] = $users;

        return view('pages.back.orders', self::$dtv);
    }
}
