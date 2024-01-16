<?php

use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FrontEnd\ProductController;
use App\Http\Controllers\FrontEnd\CategoryController;
use App\Http\Controllers\FrontEnd\ShippController;
use App\Http\Controllers\SkydropxController;
use App\Livewire\ShoppingCart;
use App\Livewire\CreateOrder;

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

Route::get('/', WelcomeController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('search', SearchController::class)->name('search');

Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('cart', ShoppingCart::class)->name('cart');

Route::get('orders/create', CreateOrder::class)->name('orders.create');

Route::get('envios/todas', [ShippController::class, 'allCarriers'])->name('envios.todas');
Route::get('envios/rate', [ShippController::class, 'rate'])->name('envios.rate');
Route::get('envios/track', [ShippController::class, 'track'])->name('envios.track');

//Skydropx
Route::get('skydropx/carriers', [SkydropxController::class, 'carriers'])->name('skydropx.carriers');
Route::get('skydropx/quote', [SkydropxController::class, 'quote'])->name('skydropx.quote');

//Pruebas
Route::get('prueba/repite', [CategoryController::class, 'repite'])->name('prueba.repite');
