<?php

namespace App\Http\Controllers;

use App\model\Bayar;
use App\model\Menu;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        $id = Auth::user()->id ;
        $bayar = Bayar::all();
        foreach ($bayar as $key) {
            if($key->id_user == $id){
               $tgl = date('Y-m-d', strtotime('+3 days', strtotime($key->created_at)));
               if($tgl == $now){
                   Bayar::where('id_user',$id)->delete();
               }
            }
        }
        $now = Carbon::now()->format('Y-m-d');
        $menu = Menu::all();
        $bayar = Bayar::all();
        return view('user.penjualan.create',compact('menu','now','bayar'));
    }
}
