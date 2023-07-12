<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Member\RegisterController;
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

// Route::get('/', function () {
//     return view('admin.movies.index');
// });

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [LoginController::class, 'loginForm'])->name('admin.login.form');
    Route::post('login', [LoginController::class, 'authenticate'])->name('admin.login.authenticate');

    // middleware   
    Route::group(['middleware' => 'auth.admin'], function () {
        Route::resource('movies', MovieController::class);
        Route::get('/transaction', [TransactionController::class, 'index'])->name('admin.transaction.index');

        Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
});

Route::get('/', function () {
    return view('index');
})->name('member.index');

Route::get('/register', [RegisterController::class, 'registerForm'])->name('register');
Route::post('/register', [RegisterController::class, 'registerStore'])->name('register.store');

Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');
