<?php

use App\Http\Controllers\CurrencyController;

Route::get('/exchange-rates', [CurrencyController::class, 'fetchRates']);
