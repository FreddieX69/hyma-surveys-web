<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Livewire\App\Dashboard\Dashboard;
use App\Livewire\App\Forms\FillForm;
use App\Livewire\App\Forms\Settings;
use App\Livewire\App\InitialData\Medic\MedicFillForm;
use App\Livewire\App\InitialData\Medic\MedicIndex;
use App\Livewire\App\InitialData\SocialWorker\SocialWorkerFillForm;
use App\Livewire\App\InitialData\SocialWorker\SocialWorkerIndex;
use App\Livewire\App\Patients\PatientsIndex;
use App\Livewire\App\SocioEconomicStudies\SocioEconomicIndex;
use App\Livewire\App\Users\Users;
use App\Livewire\Auth\ChangePassword;
use App\Livewire\Auth\ForgotPassword;
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
Route::get('forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('change-password/{key}', ChangePassword::class)->name('change-password');
Route::get('error-404', [Controller::class, 'error404'])->name('404');

Route::middleware('auth')->group(function () {
    Route::get('home', [Controller::class, 'homeRoute'])->name('home');
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('users', Users::class)->name('users');
    Route::get('forms-settings', Settings::class)->name('forms-settings');
    Route::get('initial-data-medic', MedicIndex::class)->name('initial-data-medic');
    Route::get('medic-fill-form', MedicFillForm::class)->name('medic-fill-form');
    Route::get('fill-form/{form_type}/{patient_id}', FillForm::class)->name('fill-form');
    Route::get('socio-economic-study', SocioEconomicIndex::class)->name('socio-economic-index');
    Route::get('social-worker-index', SocialWorkerIndex::class)->name('social-worker-index');
    Route::get('social-worker-fill', SocialWorkerFillForm::class)->name('social-worker-fill-form');
    Route::get('patients', PatientsIndex::class)->name('patients-index');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::post('logout', [Controller::class, 'logout'])->name('logout');

});
