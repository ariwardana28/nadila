<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Menu;
use App\model\Bayar;

class BayarController extends Controller
{
    public function index(){
        $now = 0;
        $menu = Menu::all();
        $bayar = Bayar::all();
        return view('welcome',compact('menu','now','bayar'));
    }
    
}
