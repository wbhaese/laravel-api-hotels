<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelsController;

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

Route::prefix('hotels')->group(function() {
    Route::get('/', [HotelsController::class, 'index'])->name('hotels-index');
    Route::get('/{id}', [HotelsController::class, 'show'])->name('hotels-show');
    Route::post('/', [HotelsController::class, 'store'])->name('hotels-store');
    Route::put('/{id}/edit', [HotelsController::class, 'update'])->where('id', '[0-9]+')->name('hotels-update');
    Route::delete('/{id}', [HotelsController::class, 'destroy'])->where('id', '[0-9]+')->name('hotels-destroy');
});