<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::apiResource('messages', MessageController::class)
     ->only(['index', 'store']);
