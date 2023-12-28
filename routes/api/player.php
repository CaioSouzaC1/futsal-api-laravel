<?php

use App\Http\Controllers\Player\PlayerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.api')->group(function () {
    Route::get('/', [PlayerController::class, 'index']);
    Route::post('/', [PlayerController::class, 'store']);
    Route::delete('/{id}', [PlayerController::class, 'delete']);
});
