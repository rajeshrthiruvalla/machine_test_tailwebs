<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;

Route::redirect('/', '/login');

Auth::routes(["register"=>false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('students', StudentController::class)->only([
    'store','edit', 'update','destroy'
]);
