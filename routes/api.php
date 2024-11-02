<?php

use App\Http\Controllers\Api\V1\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/V1/categories', [CategoryController::class, 'index']);

Route::prefix('V1')->group(function(){
    Route::apiResource('categories', CategoryController::class);
});