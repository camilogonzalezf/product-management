<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\OrdersController;
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

// Register person
Route::get('/register-person', CustomersController::class . '@index')->name('customers');

Route::post('/register-person',[CustomersController::class,'store'])->name('customers');

Route::delete('/register-person/{id}', [CustomersController::class , 'destroy'])->name('customer-destroy');

// Register product
Route::get('/register-product', ProductsController::class . '@index')->name('products');

Route::post('/register-product',[ProductsController::class,'store'])->name('products');

Route::delete('/register-product/{id}', [ProductsController::class , 'destroy'])->name('product-destroy');


// Register category
Route::get('/register-category', CategoriesController::class . '@index')->name('categories');

Route::post('/register-category',[CategoriesController::class,'store'])->name('categories');

Route::delete('/register-category/{id}', [CategoriesController::class , 'destroy'])->name('category-destroy');

// Orders
Route::get('/orders', OrdersController::class . '@index')->name('orders');

Route::post('/orders/{id}',[OrdersController::class,'store'])->name('orders');


// Order Detail
Route::get('/order-detail/{customer_id}/{great_order_id}',OrderDetailsController::class . '@index')->name('order-detail-show');

Route::post('/order-detail/{customer_id}/{product_id}/{great_order_id}',[OrderDetailsController::class,'store'])->name('order-detail-store');

Route::patch('/order-detail/{customer_id}/{order_id}/{great_order_id}/{product_id}',[OrderDetailsController::class,'update'])->name('order-detail-update');

Route::delete('/order-detail/{order_id}/{customer_id}/{great_order_id}',[OrderDetailsController::class,'destroy'])->name('order-detail-destroy');

