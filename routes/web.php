<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StockController;
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
    return view('login');
});

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('dashboard', function () {
    return view('admin.layouts.main');
});
Route::get('/stocks/list', [StockController::class, 'list'])->name('stock.list')->middleware('auth');
Route::get('/stocks/delete/{id}', [StockController::class, 'delete'])->name('stock.delete')->middleware('auth');
