<?php

use App\Http\Controllers\Team\TeamController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.api')->group(function () {
    Route::get('/', [TeamController::class, 'index']);
    Route::post('/', [TeamController::class, 'store']);
    Route::delete('/{id}', [TeamController::class, 'delete']);
});
