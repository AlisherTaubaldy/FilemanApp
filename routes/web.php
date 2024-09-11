<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/files', [FileController::class, 'index']);
Route::post('/files', [FileController::class, 'store']);
Route::get('/files/{file}', [FileController::class, 'show']);
Route::put('/files/{file}', [FileController::class, 'update']);
Route::delete('/files/{file}', [FileController::class, 'destroy']);
Route::get('/upload', [FileUploadController::class, 'index']);
