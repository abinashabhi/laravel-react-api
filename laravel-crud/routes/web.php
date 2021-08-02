<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
// use App\Mail\welcomeMail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/email', function () {
//     Mail::to('aabhi123@gmail.com')->send(new welcomeMail());

//     return new welcomeMail();
// });
Route::get("data",[PostController::class,'getData']);
Route::get("/update",[PostController::class,'update']);
