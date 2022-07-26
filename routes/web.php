<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceiveTelegramController;

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

Route::post('/receive', [ReceiveTelegramController::class, 'receive']);
Route::get('/logs', [ReceiveTelegramController::class, 'logs']);

Route::get('/', function () {
    return view('welcome');
});
