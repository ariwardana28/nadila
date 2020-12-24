<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Penjualan;
use App\model\DetailPenjualan;
use Carbon\Carbon;
use App\User;
use DB;
class LaporanPenjualanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(Request $request){

        $input = $request->all();
        if(empty($input['nama']) && !empty($input['tanggal1']) && !empty($input['tanggal2'])){
            $tanggal1 = date('Y-m-d',strtotime($input['tanggal1']));
            $tanggal2 = date('Y-m-d',strtotime($input['tanggal2']));
            $detail = Penjualan::whereBetween('tanggal', [$tanggal1, $tanggal2])->orderBy('tanggal')->get();
            return view('laporan.index', compact('detail'));
        }elseif (empty($input['tanggal1']) && empty($input['tanggal2']) && !empty($input['nama'])){
            $user  = User::where('name','like','%'.$input['nama'].'%')->get()->first();
            $detail = Penjualan::where('id_user',$user->id)->orderBy('tanggal')->get();
            return view('laporan.index', compact('detail'));
        }else{
            $detail = [];
            return view('laporan.index', compact('detail'));
        }


//    	if (empty($input)){
//    	    $detail = Penjualan::all();
//            return view('laporan.index',compact('detail'));
//        }
//    	else {
//            $detail = Penjualan::whereBetween('tanggal', [$tanggal1, $tanggal2])->orderBy('tanggal')->get();
//            return view('laporan.index', compact('detail'));
//        }


    }
}
