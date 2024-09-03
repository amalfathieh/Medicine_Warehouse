<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //ADD MEDICIN TO FAVORIT
    public function favorite($id){
        $idU=auth()->user()->id;
        $f=Favorite::where('medicine_id',$id)->get();
        if($f){
            foreach($f as $data){
                if( $data->user_id == $idU){
                    return response()->json([
                        'message'=>'The medicine already existed in favorite '
                    ],422);
                }
            }}
        Favorite::create([
            'medicine_id'=>$id,
            'user_id'=>$idU,
        ]);
        return response()->json([
            'message'=>'The medicine was added to favorite successfully'
        ],200);
    }

    //Delete from favorite
    public function Deletefavorite($id){
        Favorite::where('medicine_id',$id)->delete();
        return response()->json([
            'message'=>'The medicine delete from favorite successfully'
        ],200);
    }
    //SHOW ALL MEDICINE IN FAVORITE
    public function showFavorite(){
        $id=auth()->user()->id;
        $user=User::find($id);
        $medicines = $user->medicines;
        return response()->json([
            'data' => $medicines,
            'message'=>'success',
            'status'=> 200
        ], 200);
    }
}
