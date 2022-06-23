<?php

use App\Http\Controllers\SettingController;
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
    return view('welcome');
});

Route::get('company-detail', [SettingController::class, 'index'])->name('company_detail');
Route::post('filter', [SettingController::class, 'filter'])->name('filter');

Route::get('pdf', [SettingController::class, 'pdf_index'])->name('pdf_index');
Route::post('store', [SettingController::class, 'pdf_upload'])->name('pdf_upload');


