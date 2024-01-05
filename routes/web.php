<?php

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

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

Route::get('/form', [UserController::class, 'index'])->name('form');
Route::post('/save-data', [UserController::class, 'saveData'])->name('saveData');
Route::get('/store-excel', [ExcelController::class, 'storeExcel'])->name('storeExcel');
Route::get('/send-mail', function () {
    return view('send-mail');
});

Route::post('/send-mail', [MailController::class, 'sendMail']);
