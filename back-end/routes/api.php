<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FilerController;
use App\Http\Controllers\InvitationController;

// Route::get('/user', function (Request $request) {
//     return $request->user();S
// })->middleware('auth:sanctum');

//Route::post("/filler", [FilerController::class, "__invoke"]);

//assume there are log in and sign up
Route::post("/upload_file", [FilerController::class, "uploadFile"]); //ma ela aaze iza aana realtime

Route::post("/get_your_ws", [FilerController::class, "displayOwnedLandingScreen"]);
Route::post("/get_coll_ws", [FilerController::class, "displayCollabLandingScreen"]);

Route::post("/get_work_space/{id}", [FilerController::class, "getWorkSpace"]);
Route::post("/get_file/{id}", [FilerController::class, "getFile"]); //inside a work space
Route::post("/send_email", [InvitationController::class, "sendEmail"]);
//get workspace (for both user and collaberators)
//in landing page show the workspace for user
//in landing page show the workspace for invited