<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Test\TestOrderController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

route::get('/orders', [OrderController::class, 'unreleasedOrdersIndex'])->name('orders.unreleasedOrdersIndex');
route::patch('/orders/{order}', [OrderController::class, 'releaseBillOfLading'])->name('orders.releaseBillOfLading');

route::get('/test/orders/{order}', [TestOrderController::class, 'testReleaseBillOfLading'])->name('orders.testReleaseBillOfLading');

require __DIR__.'/auth.php';
