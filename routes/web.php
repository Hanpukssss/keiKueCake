<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/dashboard', 'dashboard');
Route::view('/products', 'products.index');
Route::view('/transactions', 'transactions.index');
Route::view('/catalog', 'catalog');
Route::view('/home', 'home');
