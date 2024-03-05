<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    //REGISTER METHOD -POST
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name'=>['required'],
            'phone'=>['required','digits:10','unique:users,phone'],
            'password'=>['required']
        ]);
        $admin=User::query()->create([
            'name'=>$request['name'],
            'phone'=>$request['phone'],
            'password'=>Hash::make($request->password),
            'role'=>'admin',
        ]);
        $token=$admin->createToken("API TOKEN")->plainTextToken;
        $data =[];
        $data['user']= $admin;
        $data['token']=$token;
        return response()->json([
           'status'=>1,
           'data'=>$data,
           'message'=>'Admin create successfully'
        ]);

    }

    //LOGIN METHOD -POST
    public function login(Request $request){
        $request->validate([
            'phone'=>['required','digits:10','exists:users,phone'],
            'password'=>['required']
        ]);
        if(!Auth::attempt($request->only(['phone','password']))){
            $message='Mobile phone & password does not match with our record.';
            return response()->json([
                'data'=>[],
                'status'=>0,
                'message'=>$message
            ],500);
        }
        $user=User::query()->where('phone','=',$request['phone'] )->first();
        $token = $user->createToken("API TOKEN")->plainTextToken;
        $data['user']=$user;

        $data['token']=$token;

        return response()->json([
            'status'=>1,
            'data'=>$data,
            'message'=>'Admin logged in successfully'
        ]);
    }

    //LOGOUT METHOD -GET
    public function logout(): \Illuminate\Http\JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'status'=>1,
            'data'=>[],
            'message'=>'Admin logged out successfully' ]);
    }
}
