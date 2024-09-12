<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // routing for books
    Route::resource('books', BookController::class)
        ->only(['index', 'store', 'update', 'destroy']);
    // routing for authors
    Route::resource('authors', AuthorController::class)
        ->only(['index', 'store', 'update', 'destroy']);
});
