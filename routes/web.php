<?php

use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('transaksi.index');
});

Route::resource('transaksi', TransaksiController::class);
