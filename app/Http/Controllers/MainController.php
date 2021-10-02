<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class MainController extends Controller
{
    public static $dtv = ['page_title' => 'Gems | '];
    public function __construct()
    {
        self::$dtv['menu'] = Menu::all();
    }
}
