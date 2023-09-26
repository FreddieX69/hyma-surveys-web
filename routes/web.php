<?php

use App\Http\Controllers\Controller;
use App\Livewire\App\Dashboard;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('', Login::class)->name('login');
Route::middleware('auth')->group(function () {
    Route::get('home', [Controller::class, 'homeRoute'])->name('home');
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::post('logout', [Controller::class, 'logout'])->name('logout');
});
