<?php

use App\Http\Controllers\ProxyController;
use Illuminate\Support\Facades\Route;

Route::withoutMiddleware('web')
     ->middleware([
         \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
         \Illuminate\Routing\Middleware\SubstituteBindings::class
     ])
     ->any('{any}', [ProxyController::class, 'index'])
     ->where('any', '.*');
