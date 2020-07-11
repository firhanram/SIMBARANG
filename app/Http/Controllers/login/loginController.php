<?php

namespace App\Http\Controllers\login;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class loginController extends Controller
{
    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;

        $check = DB::table('users')
                    ->join('user_roles','users.role_id','=','user_roles.role_id')
                    ->where('username', $username)
                    ->first();

        $request->validate([
            'username' => 'required',
            'password' => 'required|sometimes|min:8'
        ]);

        if($check){
            if(Hash::check($password, $check->password)){
                Session::put([
                    'username'=> $check->username,
                    'name'=>$check->nama,
                    'user_id'=>$check->user_id,
                    'role_id'=>$check->role_id,
                    'role'=>$check->role,
                    'login'=>TRUE
                ]);

                if($check->role_id == 1){
                    return redirect('/dashboard');
                } else {
                    return redirect('/login');
                }
                
            }else {
                return redirect('/login')->with('error','Password is incorrect');
            }
        }else {
            return redirect('/login')->with('error','Username or Password is incorrect');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/login');
    }
}
