<?php

use App\Http\Controllers\Web\TelegramController;
use Illuminate\Support\Facades\Route;

Route::get('/telegram', [TelegramController::class, 'index'])->name('telegram.index');
