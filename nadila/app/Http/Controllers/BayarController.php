<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Menu;

class BayarController extends Controller
{
    public function index(){
        $menu = Menu::all();
        return view('user.menu.index',compact('menu'));
    }
}
