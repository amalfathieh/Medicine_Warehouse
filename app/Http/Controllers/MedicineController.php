<?php

namespace App\Http\Controllers;

use App\Models\Catogary;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller
{
    // ADD MEDICINE
    public function create(Request $request)
    {
        $request->validate([
            'scientific_name' => ['required'],
            'commercial_name' => ['required'],
            'company' => ['required'],
            'quantity' => ['required'],
            'date' => ['required'],
            'price' => ['required'],
            'image' => ['image', 'mimes:jpeg,png,bmp,jpg,gif,sav'],
        ]);

        $image = $request->file('image');
        $medicine_image = 'image/1546140.png';
        if ($request->hasFile('image')) {
            $medicine_image = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $medicine_image);
            $medicine_image = 'image/' . $medicine_image;
        }

        $medicine = Medicine::query()->create([
            'scientific_name' => $request['scientific_name'],
            'commercial_name' => $request['commercial_name'],
            'catogary_id' => $request['catogary_id'],
            'company' => $request['company'],
            'quantity' => $request['quantity'],
            'date' => $request['date'],
            'price' => $request['price'],
            'image' => $medicine_image,
        ]);

        return response()->json([
            'status' => 1,
            'data' => $medicine,
            'message' => 'The medicine was added successfully'
        ]);
    }
    // GET ALL CATOGARY
    public function getCatogary()
    {
        return Catogary::get();
    }

    // GET ALL MEDICINES
    public function getAllMedicine()
    {
        return Medicine::with('catogary')->get();
    }

    public function date($id)
    {
        $getId = DB::table('medicines')->where('id', $id)->pluck('created_at');
        return $getId;
    }


    //SHOW MEDICINE BY CATOGARY
    public function showMedicine($id)
    {
        $catogary = Catogary::find($id);
        return $catogary->medicines;
    }

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
    //SHOW ALL MEDICIN IN FAVORITE
    public function showFavorite(){
        $id=auth()->user()->id;
        $user=User::find($id);
        return $user->medicines;
    }

    //SEARCH BY NAME(SCIENTIFIC OR COMMERCAL) OR CATOGARY
    public function search_catogary_or_name($x)
    {
        $ca = Catogary::where('catogary', '=', $x)->first();
        if ($ca) {
            $po = $ca->id;
            $catogary = Catogary::find($po);
        }
        $medicine = Medicine::where('scientific_name', '=', $x)->first();
        $medicine1 = Medicine::where('commercial_name', '=', $x)->first();

        if ($medicine) {
            return $medicine;
        }
        if ($medicine1) {
            return $medicine1;
        }
        if ($catogary) {
            return $catogary;
        } else return response()->json([
            'status' => 0,
            'data' => null,
            'message' => 'The medicine not exiest',
        ]);
    }
}
