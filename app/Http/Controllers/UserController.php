<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request){
    	$user = User::where('username', $request->username)->first();
    	return $user;
    }

    public function get_user(Request $request){
    	$user = User::where('id', $request->id)->first();
    	return $user;
    }

    public function get_nilai(Request $request){
        $user = User::where('user_level', 2)
        ->whereNotNull('nilai')
        ->get();
        return $user;
    }

    public function submit(Request $request){
        $status = array();

    	$user = User::find($request->id);
    	$user->nilai = $request->nilai;
        $user->nama = $request->nama;
        $user->no_absen = $request->no_absen;
        $user->kelas = $request->kelas;
		$status_user = $user->save();
        
        $status["status"] = $status_user == 1 ? 'success' : 'failed';
    	return $status;
    }
}
