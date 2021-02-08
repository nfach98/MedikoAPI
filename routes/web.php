<?php

use Illuminate\Support\Facades\Route;

Route::post('/soal', [App\Http\Controllers\SoalController::class, 'get_soal']);
Route::post('/add_soal', [App\Http\Controllers\SoalController::class, 'add']);
Route::post('/edit_soal', [App\Http\Controllers\SoalController::class, 'edit']);
Route::post('/delete_soal', [App\Http\Controllers\SoalController::class, 'delete']);

Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);
Route::post('/user', [App\Http\Controllers\UserController::class, 'get_user']);
Route::post('/nilai', [App\Http\Controllers\UserController::class, 'get_nilai']);
Route::post('/submit_nilai', [App\Http\Controllers\UserController::class, 'submit']);