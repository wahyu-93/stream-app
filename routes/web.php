<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\TransactionController;
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
    return view('admin.movies.index');
});

Route::group(['prefix' => 'admin'], function(){
    Route::resource('movies', MovieController::class);
    Route::get('/transaction', [TransactionController::class, 'index'])->name('admin.transaction.index');
});