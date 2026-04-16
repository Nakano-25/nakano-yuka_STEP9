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
Route::get('/products/purchase', [ProductController::class, 'purchase'])->name('products.purchase');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('auth');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store')->middleware('auth');
Route::get('/products/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::get('/products/{id}', [ProductController::class, 'show'])->whereNumber('id')->name('products.show');

// Mypage
Route::get('/mypage', [MypageController::class, 'index'])->name('mypage')->middleware('auth');
Route::get('/mypage/product-show', [MypageController::class, 'productShow'])->name('mypage.product.show');

// Account
Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit');

// Contact
Route::get('/contact', [ContactController::class, 'form'])->name('contact.form');