<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function prosesLogin(Request $request){
        $nik = $request->input('nik');
        $password = $request->input('password');
        if (Auth::guard('karyawan')->attempt(['nik' => $nik, 'password' => $password])) {
            return response()->json([
                'success' => true
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Login Gagal!'
            ], 401);
        }
    }

    public function logout(){
        if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }
}
