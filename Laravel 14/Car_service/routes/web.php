<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\MechanicController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('owners/{id}/cars', [OwnerController::class, 'getCars']);
Route::get('mechanics/{id}/cars', [MechanicController::class, 'getCars']);
