<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::post("/login", [AuthController::class, "login"]);

Route::apiResource("/users", UserController::class)->only(["store"]);
Route::apiResource("/events", EventController::class)->only(["index", "show"]);
Route::apiResource("/blogposts", BlogpostController::class)->only([
    "index",
    "show",
]);

Route::group(["middleware" => ["auth:sanctum"]], function () {
    Route::apiResource("/users", UserController::class)->except(["store"]);

    Route::get("/me", [AuthController::class, "whoami"]);

    Route::apiResource("/events", EventController::class)->except([
        "index",
        "show",
    ]);

    Route::apiResource("/blogposts", BlogpostController::class)->except([
        "index",
        "show",
    ]);

    Route::post("/logout", [AuthController::class, "logout"]);
});
