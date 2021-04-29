<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request){
        $field = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed',
        ]);

        $user = User::create([
            'name'=>$field['name'],
            'email'=>$field['email'],
            'password'=>bcrypt($field['password'])
        ]);

        $token =$user->createToken('myapptoken')->plainTextToken;

        $response =[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,201);
    } 
    //********************* */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
          
        ]);

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

             $token =$request->user()->createToken('myapptoken')->plainTextToken;

        

       // $token->save();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            
        ]);
    }
    public function logout(Request $request ){
       
        $request->user()->currentAccessToken()->delete();
    
        return[
            'message'=>'logged out'
        ];
    }
}
