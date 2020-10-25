<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

    public function addQty($id){
        $bayars = Bayar::find($id);
        $newQty = $bayars->qty + 1;
        $bayars->update(['qty'=>$newQty]);

        $now = Carbon::now()->format('Y-m-d');
        $menu = Menu::all();
        $bayar = Bayar::all();

        return redirect(url('penjualan/menuBayar'))
            ->with([
                'menu'=>$menu,
                'now'=>$now,
                'bayar'=>$bayar
            ]);
        //return view('user.penjualan.bayarMenu',compact('menu','now','bayar'));
    }

    public function minQty($id){
        $bayars = Bayar::find($id);
        $newQty = $bayars->qty - 1;
        $bayars->update(['qty'=>$newQty]);

        $now = Carbon::now()->format('Y-m-d');
        $menu = Menu::all();
        $bayar = Bayar::all();

        return redirect(url('penjualan/menuBayar'))
            ->with([
                'menu'=>$menu,
                'now'=>$now,
                'bayar'=>$bayar
            ]);
        //return view('user.penjualan.bayarMenu',compact('menu','now','bayar'));
    }

}
