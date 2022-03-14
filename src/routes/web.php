<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserPageController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminPageController;

use App\Http\Controllers\ProfileController;


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

Route::prefix("admin")->group(function(){
    Route::get("/login",[AdminAuthController::class,'index'])->middleware("inauth");
    Route::post("/login",[AdminAuthController::class,'login'])->middleware("inauth");
    Route::middleware("auth.admin")->group(function(){
        Route::get("/",[AdminPageController::class,'index']);
        Route::get("/get/user/{id}",[UserController::class,'showUserWithProfile']);
        Route::post("/profile/update/{id}",[ProfileController::class,'update']);
        Route::post("/user/create",[UserController::class,'createUserWithProfile']);
        Route::get("/delete/user/{id}",[UserController::class,'delete']);
        Route::get("/profile",[AdminPageController::class,'profile']);
        Route::get("/logout",[AdminAuthController::class,'logout']);
    });
});

Route::get("/login",[UserAuthController::class,'index'])->middleware("inauth");
Route::post("/login",[UserAuthController::class,'login'])->middleware("inauth");
Route::middleware("auth.user")->group(function(){
    Route::get("/",[UserPageController::class,'index']);
    Route::get("/profile",[UserPageController::class,'profile']);
    Route::get("/logout",[UserAuthController::class,'logout']);
});
