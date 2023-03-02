<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 

Route::middleware(['auth','islogin'])->group(function(){

    Route::get('dashboard', [AuthController::class, 'dashboard']); 
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('company-detail', [HomeController::class, 'index'])->name('company_detail');
    Route::post('company_ajax', [HomeController::class, 'company_ajax'])->name('company_ajax');

    Route::get('pdf', [HomeController::class, 'pdf_index'])->name('pdf_index');
    Route::post('store', [HomeController::class, 'pdf_upload'])->name('pdf_upload');
    Route::get('pdf_ajax', [HomeController::class, 'pdf_ajax'])->name('file_pdf_ajax');

});

