<?php

use Azuriom\Plugin\RankFaction\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your plugin. These
| routes are loaded by the RouteServiceProvider of your plugin within
| a group which contains the "web" middleware group and your plugin name
| as prefix. Now create something great!
|
*/

Route::get('/', [AdminController::class, 'index'])->name('settings');
Route::post('/', [AdminController::class, 'store'])->name('store');
Route::delete('/', [AdminController::class, 'destroy'])->name('destroy');

Route::resource('faction', AdminController::class);
