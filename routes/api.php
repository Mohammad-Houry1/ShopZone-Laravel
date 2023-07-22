<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/posts', [ApiController::class, 'getData']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});