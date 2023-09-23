<?php

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
    $products = \App\Models\Product::all(); // Fetch all products from the database
    return view('welcome', compact('products'));
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Product Routes
    Route::get('/products', 'ProductManagementController@index');
    Route::post('/products', 'ProductManagementController@store');
    Route::get('/products/{product}/edit', 'ProductManagementController@edit');
    Route::put('/products/{product}', 'ProductManagementController@update');
    Route::delete('/products/{product}', 'ProductManagementController@destroy');

    Route::get('/products', function () {
        return view('products.index');
    });


    // Order Routes
    Route::get('/orders', 'OrderManagementController@index');
    Route::post('/orders', 'OrderManagementController@store');
    Route::get('/orders/{order}', 'OrderManagementController@show');

    Route::get('/orders/{order}/edit', 'OrderManagementController@edit');
    Route::put('/orders/{order}', 'OrderManagementController@update');
    Route::delete('/orders/{order}', 'OrderManagementController@destroy');

    Route::get('/orders', function () {
        return view('orders.index');
    });
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
