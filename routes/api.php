<?php

use App\Http\Controllers\Api\TransportController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\MapController;
use Illuminate\Support\Facades\Route;

Route::middleware('telegram.auth')->group(function () {
    Route::get('/transports', [TransportController::class, 'index']);
    Route::get('/transports/{type}', [TransportController::class, 'byType']);
    Route::post('/tickets', [TicketController::class, 'create']);
    Route::get('/map', [MapController::class, 'getMapData']);
});
