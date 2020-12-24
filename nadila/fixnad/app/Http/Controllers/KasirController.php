<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Penjualan;
use App\model\Menu;
use App\model\DetailPenjualan;
use Carbon\Carbon;
use App\User;
use DB;

class KasirController extends Controller
{
   
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function penjualan(Request $request){
        $tanggal1 = date('Y-m-d',strtotime($request->tanggal1));
        $tanggal2 = date('Y-m-d',strtotime($request->tanggal2));
        $users =$request->user;

        $now = Carbon::now()->format('Y-m-d');
        $penjualan = Penjualan::orderByRaw('id DESC')->paginate(10); 
        $menu = Menu::all(); 
        $user = User::all();
       
    	// $detail = Penjualan::where('id_user',$users)->whereBetween('tanggal',[$tanggal1,$tanggal2])->orderBy('tanggal')->get();        
    	$detail = DetailPenjualan::all();        
        // dd($penjualan);
        $nilai = array();
        return view('kasir.index',compact('penjualan','detail','now','user','menu'));
    }

    public function show($id){
        $penjualan = Penjualan::where('id',$id)->get(); 
        $DetailPenjualan= DetailPenjualan::all();        
       
        return view('kasir.show',compact('penjualan','DetailPenjualan'));
    }
    public function print($id){
        $penjualan = Penjualan::where('id',$id)->get(); 
    	$detail = DetailPenjualan::all();        
        
        return view('kasir.print',compact('penjualan','detail'));
    }
    public function bayar(Request $request,$id)
    {
        DB::beginTransaction();
        try {
            
            // $penjualan = Penjualan::find()->get(); 
            DB::table('penjualans')->where('id',$id)->update([
                'status' => $request->status,
            ]);
            
            
            // $result = $penjualan->id;
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('kasir.print',$request->id);
      
       
       // dd( $result);
      
       //return redirect(route('pembelians.index'));
    //    return redirect(route('penjualan.show', $result));
       
    }
    public function kirim(Request $request, $id){
        $penjualan = Penjualan::find($id);
        $penjualan->status = $request->get('status');
      
        $penjualan->save();
        $resut = $penjualan->id;
        return redirect()->route('kasir.show',$resut);
    }
}