<?php

use App\Http\Controllers\AddController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

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
Route::get('/accounts', function () {
    return view('accounts');
});
Route::get('/accounts', [TransactionController::class, 'index']);
Route::get('/imports', [TransactionController::class, 'index'])->name('imports');
Route::get('/categorie', [TransactionController::class, 'index'])->name('categorie');
Route::get('/form', [TransactionController::class, 'create'])->name('form');
Route::post('/form', [TransactionController::class, 'store'])->name('formPost');
