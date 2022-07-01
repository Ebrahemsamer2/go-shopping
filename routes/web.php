<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('front.index');
})->name('index');

Route::get('/shop', function () {
    return view('front.shop');
});

Route::get('/cart', function () {
    return view('front.cart');
});

Route::get('/product/{product}', function () {
    return view('front.shop-details');
});

Route::get('/contact', function () {
    return view('front.contact');
});

Route::get('/checkout', function () {
    return view('front.checkout');
});

Route::get('/blog', function () {
    return view('front.blog');
});

Route::get('/blog/{post}', function () {
    return view('front.blog-details');
});
