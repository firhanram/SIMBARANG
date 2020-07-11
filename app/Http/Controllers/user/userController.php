<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function getRole(){
        $data = DB::table('user_roles')
                    ->get();
        return $data;
    }
    public function createUser(Request $request){

        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'email:rfc|required',
            'password' => 'required|sometimes|min:8',
            'role' => 'required'
        ]);

        try {

            $checkUsername = DB::table('users')->where('username', $request->username)
                                 ->first();

            if($checkUsername){
                return back()->with('error','Username Sudah Ada!');
            }

            DB::table('users')->insert([
                'nama' => $request->name,
                'username' => strtolower($request->username),
                'email' => strtolower($request->email),
                'password' => Hash::make($request->password),
                'role_id' => $request->role
            ]);
            
            return redirect('/user')->with('success','Data Berhasil Disimpan!');

        } catch (\Exception $e) {
            return back()->with('error','Data Gagal Disimpan!');
        }
    }

    // public function getAjax() {
    //     $data = [];
    //     $users = DB::table('users')->get();
        
    //     foreach($users as $user) {
    //         $data = [
    //             'id' => $user->user_id,
    //             'name' => $user->nama,
    //             'username' => $user->username,
    //             'email' => $user->email
    //         ];
    //     }

    //     return response()->json($data);
    // }

    public function getUsers(){
        $users = DB::table('users')
                     ->join('user_roles','users.role_id','=','user_roles.role_id')
                     ->get();
        
        // foreach($users as $user) {
        //     $edit = route('users.edit',$user->user_id);
        //     $delete = route('users.delete',$user->user_id);

        //     $data = [
        //         'name' => $user->nama,
        //         'username' => $user->username,
        //         'email' => $user->email,
        //         'action' => "<a href='{$edit}' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i></a>
        //                      <a href='{$delete}' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></a>"
        //     ];

        //     $data_users = [
        //         'data' => $data
        //     ];
        // }

        return $users;
    }

    public function getUser($id) {
        $user = DB::table('users')
                    ->join('user_roles','users.role_id','=','user_roles.role_id')
                    ->where('users.user_id',$id)
                    ->get();
        return $user;
    }

    public function updateUser(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'email:rfc|required',
            'password' => 'required|sometimes|min:8',
            'role' => 'required'
        ]);
        
        try {
            DB::table('users')->where('user_id',$request->user_id)
                ->update([
                    'nama' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id' => $request->role
                ]);
            
            return redirect('/user')->with('success','Data Berhasil Diubah!');

        } catch (\Exception $e) {
            return back()->with('error','Data Gagal Diubah!');
        }
    }

    public function deleteUser($id){
        try {

            DB::table('users')->where('user_id',$id)
                ->delete();
            
            return back()->with('success','Data Berhasil Dihapus!');
        } catch (\Exception $e) {
            return back()->with('error','Data Gagal Dihapus!');
        }
    }

    public function totalUser(){
        $totalUser = DB::table('users')->count();
        return $totalUser;
    }
}
