<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicineRequest;
use App\Models\Catogary;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller
{
    // ADD MEDICINE
    public function create(MedicineRequest $request)
    {
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
        $gatogary = Catogary::get();
        return response()->json([
            'data' => $gatogary,
            'message'=>'success',
            'status'=> 200
        ], 200);
    }

    // GET ALL MEDICINES
    public function getAllMedicine()
    {
        $medicines = Medicine::with('catogary')->get();
        return response()->json([
            'data' => $medicines,
            'message'=>'success',
            'status'=> 200
        ], 200);
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
        $medicines = $catogary->medicines;
        return response()->json([
            'data' => $medicines,
            'message'=>'success',
            'status'=> 200
        ], 200);

    }

    //SEARCH BY NAME(SCIENTIFIC OR COMMERCAL) OR CATOGARY
    public function search_catogary_or_name($x)
    {
        $catogary = Catogary::where('catogary', $x)->first();
        $medicinesCatogary = $catogary->medicines;
        $medicine = Medicine::where('scientific_name', $x)->first();
        $medicine1 = Medicine::where('commercial_name', $x)->first();

        if ($medicine) {
            return response()->json([
                'data' => $medicine,
                'message'=>'success',
                'status'=> 200
            ], 200);
        }
        if ($medicine1) {
            return response()->json([
                'data' => $medicine1,
                'message'=>'success',
                'status'=> 200
            ], 200);
        }
        if ($catogary) {
            return response()->json([
                'data' => $catogary,
                'message'=>'success',
                'status'=> 200
            ], 200);
        } else return response()->json([
            'status' => 0,
            'data' => null,
            'message' => 'The medicine not exiest',
        ]);
    }
}
