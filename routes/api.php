<?php

use Azuriom\Plugin\EfClassements\Controllers\Api\PlayerApiController;
use Azuriom\Plugin\EfClassements\Controllers\Api\FactionApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("/faction", [FactionApiController::class, 'index']);
Route::post("/faction", [FactionApiController::class, 'store']);
Route::get("/faction/{id}", [FactionApiController::class, 'show']);
Route::put("/faction/{id}", [FactionApiController::class, 'update']);
Route::delete("/faction/{id}", [FactionApiController::class, 'destroy']);

Route::get("/player", [PlayerApiController::class, 'index']);
Route::post("/player", [PlayerApiController::class, 'store']);
Route::get("/player/{id}", [PlayerApiController::class, 'show']);
Route::put("/player/{id}", [PlayerApiController::class, 'update']);
