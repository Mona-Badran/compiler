<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FilerController;
use App\Http\Controllers\InvitationController;

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

    
});