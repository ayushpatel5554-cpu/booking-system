<?php

use App\Http\Controllers\AllcholiController;
use App\Http\Controllers\BridalcholiController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TotalbookingController;
use App\Http\Controllers\VendorAuthController;

Route::get('/admin/dashboard', [PageController::class, 'dashboard'])->name('welcome');
Route::get('/admin/login', [PageController::class, 'login'])->name('login');
Route::post('dashboard', [PageController::class, 'adminlogin'])->name('admin.login');
Route::get('admin-logout', [PageController::class, 'adminlogout']);
Route::get('/admin/allcholi', [AllcholiController::class, 'allcholi']);
Route::get('/admin/bridalcholi', [BridalcholiController::class, 'bridalcholi']);
Route::get('/admin/customer', [CustomerController::class, 'customer']);
Route::get('/admin/setting', [PageController::class, 'setting']);
// Settings page jova mate
Route::get('/admin/settings', [PageController::class, 'settings'])->name('admin.settings');

// Password update karva mate
Route::post('/admin/settings/password', [PageController::class, 'updatePassword'])->name('admin.password.update');


Route::get('/vendor/totalbooking', [TotalbookingController::class, 'index']);
Route::get('/vendor/dashboard', [VendorAuthController::class, 'dashboard'])->name('vendor.dashboard');
Route::get('/', [VendorAuthController::class, 'showLogin'])->name('vendor.login');
Route::post('/vendor/login', [VendorAuthController::class, 'login'])->name('vendor.login.post');
Route::get('/vendor/logout', [VendorAuthController::class, 'logout'])->name('vendor.logout');
Route::get('/admin/vendors', [VendorAuthController::class, 'manageVendors'])->name('admin.vendors');
Route::delete('/admin/vendors/{id}', [VendorAuthController::class, 'destroyVendor'])->name('vendor.destroy');
Route::post('/admin/vendors/store', [VendorAuthController::class, 'storeVendor'])->name('vendor.store');
// આ રૂટ web.php માં હોવો જ જોઈએ
Route::put('/admin/vendors/update/{id}', [VendorAuthController::class, 'updateVendor'])->name('vendor.update');

Route::get('/admin/choli', [AllcholiController::class, 'index'])->name('choli.index');
Route::post('/admin/choli/store', [AllcholiController::class, 'store'])->name('choli.store');
Route::delete('/admin/choli/{id}', [AllcholiController::class, 'destroy'])->name('choli.destroy');
// Show edit form
Route::get('/choli/{id}/edit', [AllcholiController::class, 'edit'])->name('choli.edit');

// Update choli
Route::put('/choli/{id}', [AllCholiController::class, 'update'])->name('choli.update');
// Show Bridal Cholis
Route::get('/admin/bridalcholi', [BridalCholiController::class, 'bridalcholi'])->name('bridelcholi');

// Store Bridal Choli
Route::post('/admin/bridalcholi/store', [BridalCholiController::class, 'store'])->name('bridalcholi.store');

// Update Bridal Choli
Route::put('/admin/bridalcholi/{id}', [BridalCholiController::class, 'update'])->name('bridalcholi.update');

// Delete Bridal Choli
Route::delete('/admin/bridalcholi/{id}', [BridalCholiController::class, 'destroy'])->name('bridalcholi.destroy');
Route::get('/admin/booking/form', [TotalbookingController::class, 'bookingForm'])->name('booking.form');

// All Bookings list
Route::get('/vendor/totalbooking', [TotalbookingController::class, 'index'])->name('totalbooking');

// Add booking
Route::post('/admin/totalbooking/store', [TotalbookingController::class, 'store'])->name('totalbooking.store');

// Edit form
Route::get('/admin/totalbooking/{id}/edit', [TotalbookingController::class, 'edit'])->name('totalbooking.edit');
Route::put('/totalbooking/{id}', [TotalbookingController::class, 'update'])->name('totalbooking.update');

// Delete booking
Route::delete('/admin/totalbooking/delete/{id}', [TotalbookingController::class, 'destroy'])->name('totalbooking.delete');
Route::delete('/customer/{id}', [CustomerController::class, 'destroyCustomer'])->name('customer.destroy');
Route::get('/customers', [TotalbookingController::class, 'customer'])->name('customer'); 
// In web.php (or your routes file)
Route::get('/bookings/{booking}/bill/download', [TotalbookingController::class, 'downloadBill'])
     ->name('totalbooking.downloadBill');
Route::get('/bookings/{booking}/bill/whatsapp', [TotalbookingController::class, 'sendBillWhatsapp'])
     ->name('totalbooking.sendWhatsapp');