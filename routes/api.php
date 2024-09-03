<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\FavoriteController;
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

//register and login for admin
    Route::post('register/admin',[AdminController::class,'register']);
    Route::post('login/admin',[AdminController::class,'login']);

Route::group(['middleware'=>['auth:sanctum']],function (){
    Route::get('logout',[UserController::class,'logout']);
    Route::get('logout/admin',[AdminController::class,'logout']);

    Route::controller(MedicineController::class)->group(function (){
        //ADD MEDICINE FROM ADMIN
        Route::post('add/medicine','create')->middleware(['checkAdmin']);
        Route::get('getAllCatogary','getCatogary');
        Route::get('showMedicine/{id}','showMedicine')->middleware('checkUser');
        Route::get('search/{x}','search_catogary_or_name');
        // Route::get('date/{id}','date');
        Route::get('getAllMedicine','getAllMedicine');
    });

    Route::controller(CardController::class)->group(function (){
        Route::post('addOrder','addOrder');
        Route::get('showOrder','showOrder');
        Route::get('showAllOrder','showAllOrder')->middleware(['checkAdmin']);
        Route::get('showMedOrder/{id}','showMedOrder');
        Route::post('update/{id}','update')->middleware(['checkAdmin']);

        Route::post('f','f');
        Route::get('f','f');
        Route::get('c','c');
    });

    Route::controller(FavoriteController::class)->group(function () {
        Route::get('addToFavorite/{id}','favorite');
        Route::get('showFavorite','showFavorite');
        Route::get('deleteFavorite/{id}','Deletefavorite');
    });

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//cards

