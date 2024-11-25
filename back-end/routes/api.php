<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FilerController;
use App\Http\Controllers\InvitationController;

// Route::get('/user', function (Request $request) {
//     return $request->user();S
// })->middleware('auth:sanctum');

//Route::post("/filler", [FilerController::class, "__invoke"]);
Route::post("/upload_file", [FilerController::class, "uploadFile"]);
Route::post("/get_file/{id}", [FilerController::class, "getFile"]);
Route::post("/send_email", [InvitationController::class, "sendEmail"]);
