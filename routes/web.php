<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    $posts = DB::table('posts')->get();
    return view('welcome', ['posts' => $posts]);
})->name('home');