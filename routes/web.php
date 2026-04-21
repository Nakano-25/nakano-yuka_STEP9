<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AccountController;

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

// Top
Route::get('/', [ProductController::class, 'index'])->name('home');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}/purchase', [ProductController::class, 'purchase'])->whereNumber('id')->name('products.purchase')->middleware('auth');
Route::post('/products/{id}/purchase', [ProductController::class, 'storePurchase'])->whereNumber('id')->name('products.purchase.store')->middleware('auth');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('auth');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store')->middleware('auth');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->whereNumber('id')->name('products.edit')->middleware('auth');
Route::put('/products/{id}', [ProductController::class, 'update'])->whereNumber('id')->name('products.update')->middleware('auth');
Route::get('/products/{id}', [ProductController::class, 'show'])->whereNumber('id')->name('products.show');
Route::post('/products/{id}/like', [ProductController::class, 'toggleLike'])->name('products.like')->middleware('auth');

// Mypage
Route::get('/mypage', [MypageController::class, 'index'])->name('mypage')->middleware('auth');
Route::get('/mypage/products/{id}', [ProductController::class, 'showMyProduct'])->whereNumber('id')->name('products.my.show')->middleware('auth');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Account
Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit');

// Contact
Route::get('/contact', [ContactController::class, 'form'])->name('contact.form');