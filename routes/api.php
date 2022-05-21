<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\EventController;
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


Route::name('v1.')->prefix('v1')->group(function () {
    Route::post('auth/login', [AuthController::class, 'login'])->name('login');

    Route::get('events/search', [EventController::class, 'search'])->middleware(['auth:sanctum', 'request.logging'])->name('events.search');
});
