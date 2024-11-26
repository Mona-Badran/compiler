<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FilerController;
use App\Http\Controllers\InvitationController;

use App\Http\Controllers\JWTAuthController;
use App\Http\Middleware\JwtMiddleware;
// Route::get('/user', function (Request $request) {
//     return $request->user();S
// })->middleware('auth:sanctum');

//Route::post("/filler", [FilerController::class, "__invoke"]);
Route::post("/register", [JWTAuthController::class, "register"]);
Route::post("/login", [JWTAuthController::class, "login"]);

Route::middleware([JwtMiddleware::class])->group(function () {

    Route::post("/get_your_ws", [FilerController::class, "displayOwnedLandingScreen"]);
    Route::post("/get_coll_ws", [FilerController::class, "displayCollabLandingScreen"]);

    Route::post("/upload_file", [FilerController::class, "uploadFile"]);
    
    Route::post("/get_work_space/{id}", [FilerController::class, "getWorkSpace"]);
    Route::post("/get_file/{id}", [FilerController::class, "getFile"]); //inside a work space
    Route::post("/send_email", [InvitationController::class, "sendEmail"]);
    Route::post("/change_role", [InvitationController::class, "changeRole"]);
    Route::post("/display_collabs", [InvitationController::class, "displayCollaborators"]);
});