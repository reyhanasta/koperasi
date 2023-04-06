<?php

use App\Models\Officer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterJabatanController;
use App\Http\Controllers\CustomerAccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });
// Route::get('/officer',[OfficerController::class,'index']);
// Route::post('/save_add_pegawai',[OfficerController::class,'add_data'])->name('save_add_pegawai');
// Route::get('/officer_delete/{id}',[OfficerController::class,'delete_data'])->name('officer_delete');
// Route::get('/officer-add',[OfficerController::class,'add_page']);
// Route::get('/officer-edit/{id}',[OfficerController::class,'edit_page']);
// Route::get('/customer', function () {
//     return view('nasabah.list');
// });
//DASHBOARD
Route::get('/',[DashboardController::class,'index'])->middleware('auth');
//LOGIN
Route::get('/login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);
//RESOURCE
Route::middleware('auth')->group(function () {
    Route::resource('officer', OfficerController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('customer-account', CustomerAccountController::class);
    Route::resource('master-jabatan', MasterJabatanController::class);
    Route::resource('tr-savings', SavingController::class);
});

