<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicineRequest;
use App\Models\Category;
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
            'category_id' => $request['category_id'],
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
    // GET ALL category
    public function getcategory()
    {
        $gatogary = Category::get();
        return response()->json([
            'data' => $gatogary,
            'message'=>'success',
            'status'=> 200
        ], 200);
    }

    // GET ALL MEDICINES
    public function getAllMedicine()
    {
        $medicines = Medicine::with('category')->get();
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


    //SHOW MEDICINE BY category
    public function showMedicine($id)
    {
        $category = Category::find($id);
        $medicines = $category->medicines;
        return response()->json([
            'data' => $medicines,
            'message'=>'success',
            'status'=> 200
        ], 200);

    }

    //SEARCH BY NAME(SCIENTIFIC OR COMMERCAL) OR category

    public function searchCategoryOrName($x)
    {
        $categories = Category::where('category', 'like', '%' . $x . '%')->with('medicines')->get();

        $medicines = Medicine::where('scientific_name', 'like', '%' . $x . '%')
            ->orWhere('commercial_name', 'like', '%' . $x . '%')
            ->get();

        // تجميع النتائج
        $results = [
            'categories' => $categories,
            'medicines' => $medicines,
        ];

        if ($results['categories']->isNotEmpty() || $results['medicines']->isNotEmpty()) {
            return response()->json([
                'data' => $results,
                'message' => 'Success',
                'status' => 200
            ], 200);
        }
        return response()->json([
            'status' => 0,
            'data' => null,
            'message' => 'No matching items found',
        ]);
    }

}
