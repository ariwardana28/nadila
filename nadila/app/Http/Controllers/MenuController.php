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
      ]);
    
      // menyimpan data file yang diupload ke variabel $file
      $file = $request->file('gambar');
    
      $nama_file = time()."_".$file->getClientOriginalName();
    
            // isi dengan nama folder tempat kemana file diupload
      $tujuan_upload = 'gambar_menu';
      $file->move($tujuan_upload,$nama_file);
    
    
      Menu::create([
         'gambar' => $nama_file,
         'harga' => $request->harga,
         'nama' => $request->nama,
      ]);
    
      return redirect()->back();     
   }

  
   public function hapus(Request $request,$id){
      $menu = Menu::find($id);
      $menu->deleted =  $request->get('deleted');
      $menu->save();
     return redirect('/menu');
   }
   public function edit(Request $request,$id){
      $menu = Menu::find($id);
      $menu->deleted =  $request->get('deleted');
      $menu->save();
     return redirect('/menu');
   }

     
}
