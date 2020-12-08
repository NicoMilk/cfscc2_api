<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BlogpostController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {

// vvv décommenter si Route::resource ne fonctionne pas, effacer si OK vvv
// Route::get("/user", [UserController::class, "index"]);
// Route::post("/user", [UserController::class, "store"]);

Route::resource("user", UserController::class);
Route::resource("event", EventController::class);
Route::resource("blogpost", BlogpostController::class);
