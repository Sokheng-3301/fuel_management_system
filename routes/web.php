<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FuelsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetlangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\FuelTypeandPriceController;

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

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['lang', 'auth', 'active.menu'])->group(function () {

    Route::get('welcome', function () {
        return view('welcome');
    })->name('home');
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    Route::get('dashboard', function () {
        return view('welcome');
    })->name('home');
    Route::get('index', function () {
        return view('welcome');
    })->name('home');
    Route::get('default', function () {
        return view('welcome');
    })->name('home');
    Route::get('home', function () {
        return view('welcome');
    })->name('home');

    Route::resource('fuel', FuelsController::class);
    Route::resource('fuel-type-price', FuelTypeandPriceController::class);
    Route::post('fuel-type-price/hide', [FuelTypeandPriceController::class, 'hide'])->name('fuel-type-price.hide');
    Route::get('fuel/export/pdf', [FuelTypeandPriceController::class, 'pdf'])->name('fuel-type-price.pdf');
    Route::get('fuel/export/excel', [FuelTypeandPriceController::class, 'exportExcel'])->name('fuel-type-price.excel');
    // Route::get('fuel.asp', [FuelsController::class,'index'])->name('fuel.asp.index');

    // Supplier Route
    Route::resource('supplier', SupplierController::class)->names('supplier');
    Route::get('supplier/export/pdf', [SupplierController::class, 'pdf'])->name('supplier.pdf');
    Route::get('supplier/export/excel', [SupplierController::class, 'exportExcel'])->name('supplier.excel');



});


Route::middleware('auth', 'lang')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('lang/{locale}',[SetlangController::class, 'setlocalization'])->name('lang');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login/save', [AuthController::class, 'login'])->name('login.save');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
require __DIR__.'/auth.php';
