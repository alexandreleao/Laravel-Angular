<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function userLogin(Request $request)
    {
        $data = $request->all();

        $validacao = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if($validacao->fails()){
            return $validacao->errors();
        }

        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            $user = auth()->user();
            $user->token = $user->createToken($user->email)->accessToken;
            return $user;
        }else{
            return false;
        }



    }
}
