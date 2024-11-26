<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FilerController;
use App\Http\Controllers\InvitationController;

<<<<<<< HEAD
use App\Http\Controllers\JWTAuthController;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\WorkspaceOwnerMiddleware;
// Route::get('/user', function (Request $request) {
//     return $request->user();S
// })->middleware('auth:sanctum');

//Route::post("/filler", [FilerController::class, "__invoke"]);
Route::post("/register", [JWTAuthController::class, "register"]);
Route::post("/login", [JWTAuthController::class, "login"]);


Route::middleware([JwtMiddleware::class])->group(function () {

    Route::post("/get_your_ws", [FilerController::class, "displayOwnedLandingScreen"]); 
    Route::post("/get_coll_ws", [FilerController::class, "displayCollabLandingScreen"]); 

    
    Route::post("/get_work_space/{id}", [FilerController::class, "getWorkSpace"]);
    Route::post("/get_file/{id}", [FilerController::class, "getFile"]); 

    
    Route::post("/upload_file", [FilerController::class, "uploadFile"]);

    
    Route::middleware([WorkspaceOwnerMiddleware::class])->group(function () {
        Route::post("/display_collabs", [InvitationController::class, "displayCollaborators"]);
        Route::post("/send_email", [InvitationController::class, "sendEmail"]); 
        Route::post("/change_role", [InvitationController::class, "changeRole"]); 
    });



=======
use App\Http\Controllers\Auth\JWTAuthController;

Route::post("/register", [JWTAuthController::class, "register"]);
Route::post("/login", [JWTAuthController::class, "login"]);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::post("/get_your_ws", [FilerController::class, "displayOwnedLandingScreen"]); 
    Route::post("/get_coll_ws", [FilerController::class, "displayCollabLandingScreen"]); 
    
    Route::post("/get_work_space/{id}", [FilerController::class, "getWorkSpace"]); 
    Route::post("/get_file/{id}", [FilerController::class, "getFile"]);

    Route::post("/upload_new_file", [FilerController::class, "uploadNewFile"]);

    Route::middleware([WorkspaceOwnerAuth::class])->group(function () {
        Route::post("/display_collabs", [InvitationController::class, "displayCollaborators"]); 
        Route::post("/send_email", [InvitationController::class, "sendEmail"]);
        Route::post("/change_role", [InvitationController::class, "changeRole"]); 
    });

    
>>>>>>> 7367e7c2d3d14e8316c1c252c91a16db4e1b52cc
});