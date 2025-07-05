<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FuelsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetlangController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SaleManagementController;
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

    // Fuel Inventory Route
    Route::resource('fuel', FuelsController::class);
    Route::get('fuel/inventory/export/pdf', [FuelsController::class, 'pdf'])->name('fuel.pdf');
    Route::get('fuel/inventory/export/excel', [FuelsController::class, 'exportExcel'])->name('fuel.excel');



    // Fuel Type and Price Route
    Route::resource('fuel-type-price', FuelTypeandPriceController::class);
    Route::post('fuel-type-price/hide', [FuelTypeandPriceController::class, 'hide'])->name('fuel-type-price.hide');
    Route::get('fuel/export/pdf', [FuelTypeandPriceController::class, 'pdf'])->name('fuel-type-price.pdf');
    Route::get('fuel/export/excel', [FuelTypeandPriceController::class, 'exportExcel'])->name('fuel-type-price.excel');

    // Supplier Route
    Route::resource('supplier', SupplierController::class)->names('supplier');
    Route::get('supplier/export/pdf', [SupplierController::class, 'pdf'])->name('supplier.pdf');
    Route::get('supplier/export/excel', [SupplierController::class, 'exportExcel'])->name('supplier.excel');


    // Customer Route
    Route::resource('customer', CustomerController::class)->names('customer');
    Route::get('customer/export/pdf', [CustomerController::class, 'pdf'])->name('customer.pdf');
    Route::get('customer/export/excel', [CustomerController::class, 'exportExcel'])->name('customer.excel');


    // Sale management Route
    Route::resource('sale', SaleManagementController::class)->names('sale');
    Route::post('sale/completed', [SaleManagementController::class, 'complete'])->name('sale.complete');
    Route::get('sale/export/pdf', [SaleManagementController::class, 'pdf'])->name('sale.pdf');
    Route::get('sale/export/excel', [SaleManagementController::class, 'exportExcel'])->name('sale.excel');
    Route::get('sale/{id}/invoice', [SaleManagementController::class, 'invoice'])->name('sale.invoice');
});


Route::middleware('auth', 'lang')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('lang/{locale}', [SetlangController::class, 'setlocalization'])->name('lang');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login/save', [AuthController::class, 'login'])->name('login.save');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
require __DIR__ . '/auth.php';
