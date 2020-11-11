<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\model\Menu;
use App\model\Bayar;
use Auth;
use Illuminate\Support\Facades\DB;

class BayarController extends Controller
{
    public function index(){
        $now = Carbon::now()->format('Y-m-d');
        // echo $now.'<br>';
        $id = Auth::user()->id ;
        $bayar = Bayar::all();
        foreach ($bayar as $key) {
            if($key->id_user == $id){
               $tgl = date('Y-m-d', strtotime('+3 days', strtotime($key->created_at)));
               if($tgl == $now){
                   Bayar::where('id_user',$id)->delete();
                   return redirect('/home');
                   
               }
            }
        }
        $now = 0;
        $menu = Menu::all();
        return view('welcome',compact('menu','now','bayar'));
    }

    public function addQty($id){
        try{
            DB::beginTransaction();

            $bayars = Bayar::find($id);
            $newQty = $bayars->qty + 1;
            $bayars->update(['qty'=>$newQty]);

            $menus = Menu::find($bayars->id_produk);
            $new_stok = (int)$menus->stok - 1;
            $menus->stok = $new_stok;
            $menus->save();

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }

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
        try{
            DB::beginTransaction();
            $bayars = Bayar::find($id);
            $newQty = $bayars->qty - 1;
            $bayars->update(['qty'=>$newQty]);

            $menus = Menu::find($bayars->id_produk);
            $new_stok = (int)$menus->stok + 1;
            $menus->stok = $new_stok;

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }

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
