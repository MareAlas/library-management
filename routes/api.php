<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReservationController;

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('books', [BookController::class, 'index']);
    Route::get('books/{id}', [BookController::class, 'show']);
    Route::post('books', [BookController::class, 'store'])->middleware('can:admin-only');
    Route::put('books/{id}', [BookController::class, 'update'])->middleware('can:admin-only');
    Route::delete('books/{id}', [BookController::class, 'destroy'])->middleware('can:admin-only');

    Route::get('authors', [AuthorController::class, 'index']);
    Route::get('authors/{id}', [AuthorController::class, 'show']);
    Route::post('authors', [AuthorController::class, 'store'])->middleware('can:admin-only');
    Route::put('authors/{id}', [AuthorController::class, 'update'])->middleware('can:admin-only');
    Route::delete('authors/{id}', [AuthorController::class, 'destroy'])->middleware('can:admin-only');

    Route::get('members', [MemberController::class, 'index'])->middleware('can:admin-only');
    Route::get('members/{id}', [MemberController::class, 'show'])->middleware('can:admin-only');
    Route::post('members', [MemberController::class, 'store'])->middleware('can:admin-only');

    Route::get('reservations', [ReservationController::class, 'index'])->middleware('can:admin-only');
    Route::get('reservations/{id}', [ReservationController::class, 'show'])->middleware('can:admin-only');
    Route::post('reservations', [ReservationController::class, 'store'])->middleware('can:member-only');
});

/*
Route::middleware('auth:api')->group(function () {
    Route::apiResource('books', BookController::class);
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('members', MemberController::class);
    Route::apiResource('reservations', ReservationController::class);
});
*/