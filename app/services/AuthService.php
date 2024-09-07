<?php


namespace App\services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function isValidCredential($request)
    {
        $request->validate([
            'phone'=>['required','digits:10','exists:users,phone'],
            'password'=>['required']
        ]);
        if(!Auth::attempt($request->only(['phone','password']))){
            $message='Mobile phone & password does not match with our record.';
            return [
                'success'=>false,
                'message'=>$message
            ];
        }
        $user=User::query()->where('phone',$request['phone'] )->first();
        return [
            'success'=>true,
            'user'=>$user,
        ];
    }

    public function logout(){
        Auth::user()->currentAccessToken()->delete();
    }
}
