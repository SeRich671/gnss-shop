<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(IsAdmin::class)->group(function () {
    Route::get('/', AdminController::class)->name('index');
});
