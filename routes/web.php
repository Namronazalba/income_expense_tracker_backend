<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return response()->json(['Laravel' => app()->version()]);
});


// require __DIR__.'/auth.php';
