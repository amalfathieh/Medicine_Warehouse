<?php

namespace App\Http\Controllers;
use App\Http\Requests\RegisterRequest;
use App\services\AuthService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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

        return $this->success([
            'user'=>$user,
            'token' => $token
        ],'User has been register successfully');

    }

    //LOGIN METHOD -POST
    public function login(Request $request , AuthService $authService){
        $isValid = $authService->isValidCredential($request);
        if(!$isValid['success']){
            return $this->error($isValid['message'] , Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = $isValid['user'];
        $token = $user->createToken("API TOKEN")->plainTextToken;

        return $this->success([
            'user' => $user,
            'token'=> $token
        ], 'user logged in successfully');

    }

    //LOGOUT METHOD -GET
    public function logout(AuthService $authService): \Illuminate\Http\JsonResponse
    {
        $authService->logout();
        return $this->success(null , 'Logout successfully');
    }
}
