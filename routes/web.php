<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('food-app.index');
});

Route::post('/payment/create', [PaymentController::class, 'createTransaction'])->middleware('web');
Route::post('/payment/callback', [PaymentController::class, 'handleCallback']);
