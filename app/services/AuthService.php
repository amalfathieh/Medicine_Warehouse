<?php


namespace App\services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login($request){
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

        return $data;
    }

    public function logout(){
        Auth::user()->currentAccessToken()->delete();
    }
}
