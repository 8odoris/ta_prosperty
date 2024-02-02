<?php

use App\Http\Controllers\V1\SpyController;
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

Route::prefix('v1')->group(function () {
    require __DIR__ . '/auth.php';
    Route::apiResource('spies', SpyController::class)->only('index', 'store');
    Route::get('spies/random', [SpyController::class, 'random'])->middleware(['throttle:10,1'])->name('spies.random');
});
