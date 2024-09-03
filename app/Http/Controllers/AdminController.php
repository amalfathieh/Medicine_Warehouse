<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    //REGISTER METHOD -POST
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
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
           'data'=>$data,
           'message'=>'Admin create successfully',
           'status'=>1,
        ]);

    }

    //LOGIN METHOD -POST
    public function login(Request $request , AuthService $authService){
        $data = $authService->login($request);
        return response()->json([
            'data'=>$data,
            'message'=>'Admin logged in successfully',
            'status'=>1,
        ]);
    }

    //LOGOUT METHOD -GET
    public function logout(AuthService $authService): \Illuminate\Http\JsonResponse
    {
        $authService->logout();
        return response()->json([
            'data'=>[],
            'message'=>'Admin logged out successfully',
            'status'=>1,
            ]);
    }
}
