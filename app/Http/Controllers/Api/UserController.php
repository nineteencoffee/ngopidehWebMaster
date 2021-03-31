<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function login(Request $request) {

        //dd($request->all());die();

        $user = User::where('email', $request->email)->first();

        if($user){
            if(password_verify($request->password, $user->password)){
                return response()->json([
                    'success' => 1,
                    'massage' => 'Selamat Datang '.$user->name,
                    'user'=>$user
                ]); 
            }
            return $this->error('Wrong Password');
        }
        return $this->error('Email Not Found!!!');
    }

    public function error($pesan){
        return response()->json([
            'success' => 0,
            'massage' => $pesan
        ]);
    }
}

