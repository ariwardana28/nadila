<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Menu;
use App\model\Penjualan;
use App\model\DetailPenjualan;
use Carbon\Carbon;
use DB;

class PenjualanController extends Controller
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

    public function index(){
        $penjualan = Penjualan::orderBy('tanggal', 'desc')->get();
        $DetailPenjualan = DetailPenjualan::orderBy('tanggal', 'desc')->get();
        return view('user.penjualan.index',compact('penjualan','DetailPenjualan'));
    }
    public function create(){
        $now = Carbon::now()->format('Y-m-d');
        $menu = Menu::all();
        return view('user.penjualan.create',compact('menu','now'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        try {
            $request->validate([
                'tanggal',
                'total',
                'meja',
                'id_user',
            ]);
            $penjualan = Penjualan::create($request->all());
            $now = Carbon::now()->format('Y-m-d');

            // dd($penjualan);
            $input = $request->all();

            $lastid =  DetailPenjualan::all();
            $result = $penjualan->id;
            foreach ($input['id_menu'] as $key => $row) {
                $detail_penjualan = new DetailPenjualan();
                $menu = Menu::where('id', $input['id_menu'][$key])->first();
                $detail_penjualan->id_penjualan = $penjualan->id;

                $detail_penjualan->id_menu = $input['id_menu'][$key];;
                $detail_penjualan->id_user = $input['id_user'];
                $detail_penjualan->tanggal =  $input['date'][$key];;
                $detail_penjualan->status =  $input['bay'][$key];;
                // $detail_penjualan->status = $input['status'][$key];;

                $detail_penjualan->qty = $input['qty'][$key];
                $detail_penjualan->subtotal = $input['subtotal'][$key];
                $detail_penjualan->save();

            }
            $result = $penjualan->id;
            DB::commit();
       } catch (Exception $e) {
           DB::rollBack();
       }


       // dd( $result);

       //return redirect(route('pembelians.index'));
       return redirect(route('penjualan.show', $result));
    }

    public function show($id){
        $penjualan = Penjualan::where('id',$id)->get();
        $DetailPenjualan = DetailPenjualan::where('id_penjualan',$id)->get();

        return view('user.penjualan.show',compact('penjualan','DetailPenjualan'));
    }
}
