<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route; 

Route::get('/admin/absensi', [AbsensiController::class, 'index']);
