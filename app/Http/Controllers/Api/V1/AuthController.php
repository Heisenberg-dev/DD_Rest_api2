<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use App\Models\User;


class AuthController extends Controller
{
    public function register(StoreUserRequest $request){

        try {
            $user = User::create($request->all());

            return response()->json([
                "message" => "You successfully registred.",
                "user" => $user
            ], 201);

       } catch (Exception $e){
            return response()->json([
            "message" => "Failed to registre user.",
            "error" => $e->getMessage()
        ], 500);
      }

    }
  
    public function login (LoginUserRequest $request) {

        if(!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                "message" => "There is no user with this email or password"
            ], 401
        );

        }

        $user = User::query()->where('email', $request->email)->first();
        // $user = Auth::user();

            return response()->json([
                "user" =>  [
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email,
                    "token" => $user->createToken("Token of user: {$user->name}")->plainTextToken
    
                ]
            ]);
        }
        

    public function logout(){

        Auth::logout();

        return response()->json([
            "message" => "Successfully logged out"
        ]);
    }
}
