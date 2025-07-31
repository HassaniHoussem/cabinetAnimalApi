<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function Register(Request $request){
        $request->validate([
            "name"=> "required|string",
            "email"=> "required|email|unique:users,email",
            "password"=> "required|confirmed",
        ]);
        User::create($request->all());
        return response()->json([
            "status"=> true,
            "message"=> "User registered successfully ",
        ]);

    }
    public function Login(Request $request){
       $request->validate([
            "email"=> "required|email",
            "password"=> "required",
        ]);
       $user= User::where("email",$request->email)->first();
       if(!empty( $user)){
        if(Hash::check($request->password,$user->password)){
            $token=$user->createToken("myToken")->plainTextToken;
            return response()->json([
                "status"=> true,
            "message"=> "User Logged in successfully ",
            "token"=> $token
            ]);
       }
       return response()->json([
                "status"=> false,
            "message"=> "password didnt match  ",

            ]);

        } return response()->json([
                "status"=> false,
            "message"=> "email didnt match  ",

            ]);
    }
    public function Profile (){
        $userdata=auth()->user();
        return response()->json([
             "status"=> true,
            "message"=> "Profile data",
            "data"=> $userdata,
            "id"=> auth()->user()->id,
        ]);
    }

    public function Logout (){
        auth()->user()->tokens()->delete();
        return response()->json([
             "status"=> true,
            "message"=> "User Logged out",

        ]);

    }

}
