<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/register-person', CustomersController::class . '@index')->name('customers');

Route::post('/register-person',[CustomersController::class,'store'])->name('customers');

Route::delete('/register-person/{id}', [CustomersController::class , 'destroy'])->name('customer-destroy');


Route::get('/register-product', ProductsController::class . '@index')->name('products');

Route::post('/register-product',[ProductsController::class,'store'])->name('products');

Route::delete('/register-product/{id}', [ProductsController::class , 'destroy'])->name('product-destroy');



Route::get('/register-category', CategoriesController::class . '@index')->name('categories');

Route::post('/register-category',[CategoriesController::class,'store'])->name('categories');

Route::delete('/register-category/{id}', [CategoriesController::class , 'destroy'])->name('category-destroy');

