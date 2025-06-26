<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PartialsController;

Route::get('/', function () {
    return redirect('/listings');
})->name('index');
Route::get('/return', function () {
    return back();
})->name('return');
Route::get('/auth/register', [RegisterController::class, 'show'])->middleware('guest')->name('auth.register');
Route::post('/auth/register', [RegisterController::class, 'register'])->middleware('guest')->name('auth.register');
Route::get('/auth/login', [LoginController::class, 'show'])->middleware('guest')->name('auth.login');
Route::post('/auth/login', [LoginController::class, 'login'])->middleware('guest')->name('auth.login');
Route::post('/auth/logout', [LogoutController::class, 'logout'])->middleware('auth')->name('auth.logout');

Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.index');
Route::get('/admin/users', [AdminController::class, 'users'])->middleware(['auth', 'admin'])->name('admin.users');
Route::get('/admin/users/{id}', [AdminController::class, 'showUser'])->middleware(['auth', 'admin'])->name('admin.user.show');
Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->middleware(['auth', 'admin'])->name('admin.user.edit');
Route::put('/admin/users/{id}/edit', [AdminController::class, 'updateUser'])->middleware(['auth', 'admin'])->name('admin.user.edit');
Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser'])->middleware(['auth', 'admin'])->name('admin.user.destroy');
Route::get('/admin/listings', [AdminController::class, 'listings'])->middleware(['auth', 'admin'])->name('admin.listings');
Route::get('/admin/listings/{id}', [AdminController::class, 'showListing'])->middleware(['auth', 'admin'])->name('admin.listing.show');
Route::get('/admin/listings/{id}/edit', [AdminController::class, 'editListing'])->middleware(['auth', 'admin'])->name('admin.listing.edit');
Route::put('/admin/listings/{id}/edit', [AdminController::class, 'updateListing'])->middleware(['auth', 'admin'])->name('admin.listing.edit');
Route::delete('/admin/listings/{id}', [AdminController::class, 'destroyListing'])->middleware(['auth', 'admin'])->name('admin.listing.destroy');

Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');
Route::get('/listings/create', [ListingController::class, 'create'])->middleware(['auth', 'merchant'])->name('listings.create');
Route::get('/listings/{id}', [ListingController::class, 'show'])->name('listings.show');
Route::post('/listings', [ListingController::class, 'store'])->middleware(['auth', 'merchant'])->name('listings.store');
Route::delete('/listings/{id}', [ListingController::class, 'destroy'])->middleware(['auth', 'merchant', 'listing-owner'])->name('listings.destroy');
Route::get('/listings/{id}/edit', [ListingController::class, 'edit'])->middleware(['auth', 'merchant', 'listing-owner'])->name('listings.edit');
Route::put('listings/{id}/edit', [ListingController::class, 'update'])->middleware(['auth', 'merchant', 'listing-owner'])->name('listings.edit');
Route::get('listings/{id}/add-stock', [ListingController::class, 'add'])->middleware(['auth', 'merchant', 'listing-owner'])->name('listings.stock.add');
Route::post('listings/{id}/add-stock', [ListingController::class, 'append'])->middleware(['auth', 'merchant', 'listing-owner'])->name('listings.stock.add');
Route::get('listings/{id}/ratings', [ListingController::class, 'createRating'])->middleware(['auth'])->name('listings.ratings.create');
Route::post('listings/{id}/ratings', [ListingController::class, 'storeRating'])->middleware(['auth'])->name('listings.ratings.store');

Route::get('/user/{id}/cart', [CartController::class, 'show'])->middleware(['auth', 'owner'])->name('user.cart.show');
Route::put('/user/{id}/cart/add/{copy_id}', [CartController::class, 'add'])->middleware(['auth', 'owner'])->name('user.cart.add');

Route::get('/user/{id}/profile', [ProfileController::class, 'show'])->name('user.profile.show');
Route::get('/user/{id}/profile/edit', [ProfileController::class, 'edit'])->middleware(['auth', 'owner'])->name('user.profile.edit');
Route::put('user/{id}/profile/edit', [ProfileController::class, 'update'])->middleware(['auth', 'owner'])->name('user.profile.update');

Route::get('/user/{id}/merchant-profile', [ProfileController::class, 'showMerchant'])->name('user.profile.merchant.show');
Route::get('/user/{id}/merchant-profile/create', [ProfileController::class, 'createMerchant'])->middleware(['auth', 'not-merchant', 'owner'])->name('user.profile.merchant.create');
Route::put('/user/{id}/merchant-profile/create', [ProfileController::class, 'assignMerchant'])->middleware(['auth', 'not-merchant', 'owner'])->name('user.profile.merchant.create');
Route::get('/user/{id}/merchant-profile/edit', [ProfileController::class, 'editMerchant'])->middleware(['auth', 'merchant', 'owner'])->name('user.profile.merchant.edit');
Route::put('/user/{id}/merchant-profile/edit', [ProfileController::class, 'updateMerchant'])->middleware(['auth', 'merchant', 'owner'])->name('user.profile.merchant.update');

Route::get('/partials/alert/delete/{id}', [PartialsController::class, 'delete_alert'])->name('partials.alert');
