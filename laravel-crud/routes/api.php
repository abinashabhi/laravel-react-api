<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('user-profile', function(Request $request){
//     return  $request->header('Authorization');
// });

Route::post('create',[PostController::class,'create']);
Route::post('signup',[PostController::class,'signUp']);
// Route::post('login',[PostController::class,'login']);
Route::get('data',[PostController::class,'show']);
Route::delete('delete/{id}',[PostController::class,'delete']);
Route::get('edit/{id}',[PostController::class,'edit']);
Route::post('/update',[PostController::class,'update']);
Route::get('/mail/{id}',[PostController::class,'sendMail']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::post('login', [AuthController::class, 'login']);
    // Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user-profile', [AuthController::class, 'userProfile']);
});