<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/', HomeController::class)->name('index');

Route::get('/shop', function () {
    return view('front.shop');
})->name('shop');

Route::get('/category/{category:slug}', function () {
    return view('front.category');
})->name('category');


Route::get('/cart', function () {
    return view('front.cart');
});

Route::get('/product/{product}', function () {
    return view('front.shop-details');
})->name('product');

Route::get('/contact', function () {
    return view('front.contact');
})->name('contact');

Route::get('/checkout', function () {
    return view('front.checkout');
});

Route::get('/blog', function () {
    return view('front.blog');
})->name('blog');

Route::get('/blog/{post:slug}', function () {
    return view('front.blog-details');
})->name('post');
