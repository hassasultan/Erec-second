<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::Post('create/user',[UserController::class,'create']);
Route::Post('create/logged_in',[UserController::class,'loggedInCreate']);
Route::Post('destroy/logged_in',[UserController::class,'loggedInDelete']);
Route::get('classes/list',[ClassController::class,'index']);
Route::Post('classes/create',[ClassController::class,'create_Class']);
Route::Post('classes/update',[ClassController::class,'update_Class']);
Route::Post('user/classes/create',[ClassController::class,'createUserClass']);
Route::post('user/assign/test',[UserController::class,'assignCandidate']);
Route::get('qst/to/classes',[ClassController::class,'qstClasses']);
Route::get('single/qst',[ClassController::class,'qst']);
Route::get('single/class',[ClassController::class,'SpecificClass']);
Route::get('logged/user',[UserController::class,'loggedInDetails']);
Route::get('user/qst/Socre',[ClassController::class,'qstSocre']);
