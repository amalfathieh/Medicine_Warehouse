<?php

namespace App\Http\Controllers;
use App\Http\Requests\RegisterRequest;
use App\services\AuthService;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    //REGISTER METHOD -POST
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $user=User::query()->create([
            'name'=>$request['name'],
            'phone'=>$request['phone'],
            'password'=>Hash::make($request->password),
            'role'=>'user',
        ]);
        $token=$user->createToken("API TOKEN")->plainTextToken;
        $data =[];
        $data['user']= $user;
        $data['token']=$token;
        return response()->json([
           'data'=>$data,
           'message'=>'user create successfully',
            'status'=>1
        ]);

    }

    //LOGIN METHOD -POST
    public function login(Request $request , AuthService $authService){

        $data = $authService->login($request);

        return response()->json([
            'status'=>1,
            'data'=>$data,
            'message'=>'user logged in successfully'
        ]);
    }

    //LOGOUT METHOD -GET
    public function logout(AuthService $authService): \Illuminate\Http\JsonResponse
    {
        $authService->logout();
    return response()->json([
        'status'=>1,
        'data'=>[],
        'message'=>'user logged out successfully' ]);
    }
}
