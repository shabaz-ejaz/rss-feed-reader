<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
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
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/feed/{id}', [DashboardController::class, 'show'])->middleware(['auth'])->name('feed');
Route::post('/feed', [DashboardController::class, 'create']);

require __DIR__.'/auth.php';
