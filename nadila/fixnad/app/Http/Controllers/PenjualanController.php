<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\model\Menu;
use App\model\Penjualan;
use App\model\Bayar;
use App\model\DetailPenjualan;
use Carbon\Carbon;
use DB;
use Auth;

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
        $now = Carbon::now()->format('Y-m-d');
        $penjualan = Penjualan::orderBy('tanggal', 'desc')->get();
        $DetailPenjualan = DetailPenjualan::orderBy('tanggal', 'desc')->get();
        $bayar = Bayar::where('id_user',Auth::user()->id)->get();
        //return $bayar;
        $menu = Menu::all();
        return view('user.penjualan.index',compact('penjualan','DetailPenjualan','bayar','menu','now'));
    }

    public function konfirmasi(Request $request){
        DB::beginTransaction();
        try {
            $now = Carbon::now()->format('Y-m-d');
            $penjualan = Penjualan::orderBy('tanggal', 'desc')->get();
            $DetailPenjualan = DetailPenjualan::orderBy('tanggal', 'desc')->get();
            $bayar = Bayar::where('id_user',Auth::user()->id)->get();
            foreach ($penjualan as $item) {
                $tgl = date('Y-m-d', strtotime('+3 days', strtotime($item->tanggal)));
                $det = DetailPenjualan::where('id_penjualan', $item->id)->get();
                // $aw = $det->id_menu;
                foreach ($det as $key ) {
                    $menus = Menu::where('id', $key->id_menu)->first();
                    if($tgl <= $now){
                        $new_stok = $menus->stok + $key->qty;
                        $menus->stok = $new_stok;
                        $menus->save();
                        // DB::table('detail_penjualan')->where('id_penjualan',$item->id)->delete();
                        // DB::table('penjualan')->where('id',$item->id)->delete();
                    }
                }
                if($tgl <= $now){
                    // $new_stok = $menu->stok + $det->qty;
                    // $menu->stok = $new_stok;
                    // $menu->save();
                    DB::table('detail_penjualans')->where('id_penjualan',$item->id)->delete();
                    DB::table('penjualans')->where('id',$item->id)->delete();
                }

            }
            DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
            }
        
        //return $bayar;
        $menu = Menu::all();
        return view('user.penjualan.konfirmasi',compact('penjualan','DetailPenjualan','bayar','menu','now'));
    }

    public function detail($id){
        $detail = Menu::where('id',$id)->get();
        $bayar = Bayar::all();
        $menu = Menu::all();
        return view('user.penjualan.detail',compact('detail','bayar','menu'));
    }
    public function storeBayar(Request $request){

        $input = $request->all();
        $bayar = new Bayar();
        if($bayar->id_produk !=null){
            $pay = Bayar::where('id_produk', $input['id_produk'])->first();
            $result = $pay->id_produk;
            // dd($pay);
            $menus = Menu::where('id', $input['id_produk'])->first();
            if ($input['qty']> $menus->stok){
                return redirect(url('penjualan/create'));
            }
            if ($input['id_produk'] == $pay->id_produk){
                $new_stoks = (int)$pay->qty + (int)$input['qty'];
                $pay->qty = $new_stoks;
                $pay->save();
            }else{
                $bayar->id_produk = $input['id_produk'];
                $bayar->id_user = $input['id_user'];
                $bayar->qty = $input['qty'];
                $bayar->save();
            }
            $new_stok = (int)$menus->stok - (int)$input['qty'];
            $new = (int)$menus->harga_beli+0;
            $menus->stok = $new_stok;
            $menus->save();
            return redirect(url('penjualan/create'));
        }
        elseif($bayar->id_produk ==null){
            $result = $input['id_produk'];
            $menus = Menu::where('id', $input['id_produk'])->first();
            if ($input['qty']> $menus->stok){
                return redirect(url('penjualan/detail/'.$result.'?nama=habis'));
            }

                $bayar->id_produk = $input['id_produk'];
                $bayar->id_user = $input['id_user'];
                $bayar->qty = $input['qty'];
                $bayar->save();

            $new_stok = (int)$menus->stok - (int)$input['qty'];
            $new = (int)$menus->harga_beli+0;
            $menus->stok = $new_stok;
            $menus->save();
            return redirect(url('penjualan'));
        }
    }

    public function storeBayarDet(Request $request){
        $input = $request->all();
        $bayar = new Bayar();
        $pay = Bayar::where('id_produk', $input['id_produk'])->first();
        //  dd($pay);
        $menus = Menu::where('id', $input['id_produk'])->first();
        if ($input['qty']> $menus->stok){
             return redirect(url('penjualan/create?nama=habis'));
        };
        if ($input['id_produk'] == $pay->id_produk){
            $new_stoks = (int)$pay->qty + (int)$input['qty'];
            $pay->qty = $new_stoks;
            $pay->save();
        }else{
            $bayar->id_produk = $input['id_produk'];
            $bayar->id_user = $input['id_user'];
            $bayar->qty = $input['qty'];
            $bayar->save();
        }


         $new_stok = (int)$menus->stok - (int)$input['qty'];
         $new = (int)$menus->harga_beli+0;
         //$a->harga_beli=(int)$input['harga_beli'][$key];
         $menus->stok = $new_stok;
         $menus->save();


       return redirect(url('penjualan/create?nama=sukses'));
    }


    public function create(){
        $now = Carbon::now()->format('Y-m-d');
        $menu = Menu::all();
        $bayar = Bayar::all();
        return view('user.penjualan.create',compact('menu','now','bayar'));
    }

    public function menuBayar(){
        $now = Carbon::now()->format('Y-m-d');
        $menu = Menu::all();
        $bayar = Bayar::all();
        return view('user.penjualan.bayarMenu',compact('menu','now','bayar'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        //return dd($request);
        try {
            $request->validate([
                'tanggal',
                'total',
                'alamat',
                'id_user',
            ]);
            $penjualan = Penjualan::create($request->all());
            // dd($penjualan);
            $now = Carbon::now()->format('Y-m-d');

            // dd($penjualan);
            $input = $request->all();

            $lastid =  DetailPenjualan::all();
            $result = $penjualan->id;
            foreach ($input['id_menu'] as $key => $row) {
                $detail_penjualan = new DetailPenjualan();
                $menus = Menu::where('id', $input['id_menu'][$key])->first();
                if ($input['qty'][$key] > $menus->stok){
                    return redirect(url('penjualan/menuBayar?id=habis'));
                };
                $menu = Menu::where('id', $input['id_menu'][$key])->first();
                $detail_penjualan->id_penjualan = $penjualan->id;

                $detail_penjualan->id_menu = $input['id_menu'][$key];
                // $detail_penjualan->id_user = $input['id_user'][$key];
                $detail_penjualan->tanggal =  $input['tanggal'][$key];
                // $detail_penjualan->status =  $input['status'][$key];
                // $detail_penjualan->status = $input['status'][$key];;

                $detail_penjualan->qty = $input['qty'][$key];
                $detail_penjualan->subtotal = $input['subtotal'][$key];
                $detail_penjualan->save();

                // stok barang
                $new_stok = (int)$menus->stok - (int)$input['qty'][$key];
                $new = (int)$menus->harga_beli+0;
                //$a->harga_beli=(int)$input['harga_beli'][$key];
                $menus->stok = $new_stok;
                $menus->save();
                // Delete Keranjang
                $bayar = DB::table('bayars')->where('id_produk',$input['id_menu'][$key])->delete();
            }
            $result = $penjualan->id;
            DB::commit();
       } catch (Exception $e) {
           DB::rollBack();
       }


       // dd( $result);

       //return redirect(route('pembelians.index'));
       return redirect(url('penjualan/show/'.$result.'?id=belum'));
    }

    public function show($id){
        $bayar = Bayar::all();
        $menu = Menu::all();
        $penjualan = Penjualan::where('id',$id)->get();
        $DetailPenjualan = DetailPenjualan::where('id_penjualan',$id)->get();

        return view('user.penjualan.show',compact('penjualan','DetailPenjualan','bayar','menu'));
    }
    public function bayar(Request $request, $id){
        $penjualan = Penjualan::find($id);
        $penjualan->status = $request->get('status');
        if($request->hasFile('foto')) {
         echo   $foto = $request->file('foto');
            $filename = $foto->getClientOriginalName();
            $foto->move(public_path('file'), $filename);
            $penjualan->foto = $request->file('foto')->getClientOriginalName();
        }

        $penjualan->save();
        $resut = $penjualan->id;
        return redirect()->route('penjualan.show',$resut);
    }
    public function hapus(Request $request,$id){
        // $input = $request->all();
        // echo $input['id_produk'];
        // $menus = Menu::where('id', $input['id_produk'])->first();
        // dd($menus);
        // $new_stok = (int)$menus->stok + (int)$input['qty'];
        // $new = (int)$menus->harga_beli+0;
        // $menus->stok = $new_stok;
        // DB::table('bayars')->where('id',$id)->delete();
        // return redirect('/penjualan/create');
    }
    public function shapus(Request $request,$id){
        $input = $request->all();
        $menus = Menu::where('id', $input['id_produk'])->first();
        $new_stok = (int)$menus->stok + (int)$input['qty'];
        $new = (int)$menus->harga_beli+0;
        $menus->stok = $new_stok;
        DB::table('bayars')->where('id',$id)->delete();
        return redirect('penjualan/create');
    }

    public function profile(){
        $profile = User::find(Auth::user()->id);
        return view('user.penjualan.show_profile',compact('profile'));
     }
}
