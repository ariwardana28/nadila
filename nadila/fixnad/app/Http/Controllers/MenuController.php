<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Menu;

class MenuController extends Controller
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

    public function index(){
        $menu = Menu::all();
        return view('menu.index',compact('menu'));
    }
      public function getUsers($id = 0){

        if($id==0){ 
           $employees = Menu::orderby('id','asc')->select('*')->get(); 
        }else{   
           $employees = Menu::select('*')->where('id', $id)->get(); 
        }
        // Fetch all records
        $userData['data'] = $employees;
   
        echo json_encode($userData);
        exit;
     }
     public function create(){
        return view('menu.create');
     }
   
   public function store(Request $request){
      $this->validate($request, [
         'gambar' => 'required',
         'harga' => 'required',
         'nama' => 'required',
         'stok' => 'required',
         'ket' => 'required',
      ]);
    
      // menyimpan data file yang diupload ke variabel $file
      $file = $request->file('gambar');
    
      $nama_file = time()."_".$file->getClientOriginalName();
    
            // isi dengan nama folder tempat kemana file diupload
      $tujuan_upload = 'gambar_menu';
      $file->move($tujuan_upload,$nama_file);
    
    
     $d= Menu::create([
         'gambar' => $nama_file,
         'harga' => $request->harga,
         'nama' => $request->nama,
         'stok' => $request->stok,
         'ket' => $request->ket,
      ]);
      // dd($d);
      return redirect('/menu');     
   }

   public function destroy($id){
      $men =Menu::where('id',$id)->delete();
      dd($men);
      // return redirect('/menu');
   }
   public function edit($id){
      $menu = Menu::where('id',$id)->get();
      return view('menu.edit', compact('menu'));
   }

   public function update(Request $request,$id){
      
      if($request->file('gambar') != null){
         $menu = Menu::find($id);
         $menu->nama = $request->nama;
         $menu->harga = $request->harga;
         $menu->ket = $request->ket;
         $menu->stok = $request->stok;

         if($request->hasFile('gambar')) {
            $foto = $request->file('gambar');
            $filename = $foto->getClientOriginalName();
            $foto->move(public_path('gambar_menu'), $filename);
            $menu->gambar = $request->file('gambar')->getClientOriginalName();
         }
 
         $menu->save();
         return redirect()->route('menu.index');
      }else{
         $menu = Menu::find($id);
         $menu->nama = $request->nama;
         $menu->harga = $request->harga;
         $menu->stok = $request->stok;
         $menu->ket = $request->ket;
         $menu->save();
         return redirect()->route('menu.index');
         // echo "isi";
      }
   }

     
}
