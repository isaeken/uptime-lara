<?php

use App\Http\Controllers\Api\MonitorController;
use App\Http\Controllers\Api\MonitorTypeController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')->group(function () {
    Route::get('/monitor-types', [MonitorTypeController::class, 'index'])->name('monitor-types');

    Route::middleware('auth.token')->group(function () {
        Route::apiResource('monitors', MonitorController::class);
    });
});

