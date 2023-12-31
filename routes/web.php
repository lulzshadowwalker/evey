<?php

use App\Http\Controllers\MarketingController;
use App\Http\Controllers\NetworkingController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingsController;
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

    Route::get('/', function () {
        return redirect()->route('dashboard.users');
    });

    Route::group(
        [
            'prefix' => 'dashboard',
            'as' => 'dashboard.',
        ],
        function () {
            Route::get('/users', [UsersController::class, 'index'])->name('users');
            Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
            Route::get('/signals', [NetworkingController::class, 'index'])->name('signals')->middleware('networking');
            Route::get('/inbox', [MarketingController::class, 'index'])->name('inbox')->middleware('marketing');
            Route::get('/role-management', [RolesController::class, 'index'])->name('role-management')->middleware('admin');
        }
    );
});
