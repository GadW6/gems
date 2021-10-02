<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class Request extends Model
{
    static public function getByIp($ip)
    {
        return (self::where('ip', $ip)->first()) ? (self::where('ip', $ip)->first()->geo) : false;
    }

    static public function addNewRecord($status, $method, $uri)
    {
        $ip = Session::get('REMOTE_ADDR');

        $record = new self();
        $record->ip = $ip;
        if (!self::getByIp($ip) && ($ip !== '127.0.0.1')) {
            $endpoint = 'https://neutrinoapi.net/ip-info';
            $client = new Client();
            $response = $client->request('GET', $endpoint, [
                'query' => [
                    'user-id' => env('API_USER_ID'),
                    'api-key' => env('API_KEY'),
                    'ip' => $ip,
                ]
            ]);
            $data = json_decode($response->getBody()->getContents());
            $country = $data->country;
            $city = $data->city;
            $record->geo = $city . ', ' . $country;
        } else {
            ($ip === '127.0.0.1') ? $record->geo = 'Home' : $record->geo = self::getByIp($ip);
        }
        $record->device = Session::get('device');
        $record->browser = Session::get('browser');
        $record->status = $status;
        $record->method = $method;
        $record->uri = $uri;
        $time = (int)((microtime(true) - LARAVEL_START) * 1000);
        $record->time = $time;
        $record->save();
    }
}
