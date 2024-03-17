<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//register and login for user
    Route::post('register',[UserController::class,'register']);
    Route::post('login',[UserController::class,'login']);
    Route::post('f',[CardController::class,'f']);
    Route::get('f',[CardController::class,'f']);
Route::get('c',[CardController::class,'c']);
//register and login for admin
    Route::post('register/admin',[AdminController::class,'register']);
    Route::post('login/admin',[AdminController::class,'login']);
Route::group(['middleware'=>['auth:sanctum']],function (){
    Route::get('logout',[UserController::class,'logout']);
    Route::get('logout/admin',[AdminController::class,'logout']);
    //ADD MEDICINE FROM ADMIN
    Route::post('add/medicine',[MedicineController::class,'create'])->middleware(['checkAdmin']);
    Route::get('getAllCatogary',[MedicineController::class,'getCatogary']);
    Route::get('showMedicine/{id}',[MedicineController::class,'showMedicine'])->middleware('checkUser');
    Route::get('search/{x}',[MedicineController::class,'search_catogary_or_name']);
   // Route::get('date/{id}',[MedicineController::class,'date']);
    Route::get('getAllMedicine',[MedicineController::class,'getAllMedicine']);
    Route::post('addOrder',[CardController::class,'addOrder']);
    Route::get('showOrder',[CardController::class,'showOrder']);
    Route::get('showAllOrder',[CardController::class,'showAllOrder'])->middleware(['checkAdmin']);
    Route::get('showMedOrder/{id}',[CardController::class,'showMedOrder']);
    Route::post('update/{id}',[CardController::class,'update'])->middleware(['checkAdmin']);
    Route::get('addToFavorite/{id}',[MedicineController::class,'favorite']);
    Route::get('showFavorite',[MedicineController::class,'showFavorite']);
    Route::get('Deletefavorite/{id}',[MedicineController::class,'Deletefavorite']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//cards

