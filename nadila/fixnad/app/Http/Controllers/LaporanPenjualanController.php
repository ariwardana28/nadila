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
    public function index(Request $request){
 
        $tanggal1 = date('Y-m-d',strtotime($request->tanggal1));
    	$tanggal2 = date('Y-m-d',strtotime($request->tanggal2));
      
        $detail = Penjualan::whereBetween('tanggal',[$tanggal1,$tanggal2])->orderBy('tanggal')->get();        
        
        return view('laporan.index',compact('detail'));
    }
}
