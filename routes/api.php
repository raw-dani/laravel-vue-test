<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\TestController;

Route::get('/server-info', [TestController::class, 'serverInfo']);
Route::get('/test', [TestController::class, 'test']);
Route::get('/test-database', [TestController::class, 'testDatabase']);
