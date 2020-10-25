<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KasirLoginController extends Controller
{
    // public function __construct(){
    //     $this->middleware('guest:admin');
    // }

    public function showLoginForm()
    {
         return view('auth.kasir-login');
    }
    public function login(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if(Auth::guard('kasir')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->intended(route('kasir'));
        }
         return redirect()->back();
         
    }
}