<?php

use App\Http\Controllers\API\PersonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::resource('/', PersonController::class);
Route::get('/',[PersonController::class,'index']);
Route::post('/',[PersonController::class,'store']);
Route::get('/{id}',[PersonController::class,'show']);
Route::delete('/{id}',[PersonController::class,'destroy']);
Route::patch('/{id}',[PersonController::class,'update']);
Route::put('/{id}',[PersonController::class,'update']);
