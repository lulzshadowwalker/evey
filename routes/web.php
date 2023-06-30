<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::group(
        [
            'prefix' => 'dashboard',
            'as' => 'dashboard.',
        ],
        function () {
            Route::get('/users', [UsersController::class, 'index'])->name('users');
            Route::get('/settings', [HomeController::class, 'settings'])->name('settings');

            Route::get('/signals', [HomeController::class, 'signals'])->name('signals');

            Route::get('/inbox', [HomeController::class, 'inbox'])->name('inbox');

            Route::get('/role-management', [RolesController::class, 'index'])->name('role-management');
        }
    );
});
