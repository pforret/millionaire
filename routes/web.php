<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [ HomeController::class, 'million']);
Route::get('/billion', [ HomeController::class, 'billion']);
Route::get('/in/{code}', [CurrencyController::class, 'show']);

Route::get('/test', [ HomeController::class, 'test']);

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

require __DIR__.'/auth.php';
