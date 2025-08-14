<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

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

Route::get('/admin/auth/{any}', [AppController::class, 'admin'])->where('any', '.*')->name('lvs.admin.auth.any');
Route::get('/admin/auth', function () { return redirect()->route('lvs.admin.auth.any', 'login'); });
Route::get('/admin', [AppController::class, 'admin'])->where('any', '.*')->name('lvs.admin');
Route::get('/admin/{any}', [AppController::class, 'admin'])->where('any', '.*')->name('lvs.admin.any');

Route::get('{any}', [AppController::class, 'app'])->where('any', '.*')->name('lvs.app.any');
Route::get('/auth', function () {return redirect()->route('lvs.app.auth.any', 'login');});
Route::get('/auth/{any}', [AppController::class, 'app'])->where('any', '.*')->name('lvs.app.auth.any');
