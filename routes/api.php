<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\DoorController;
use App\Http\Controllers\WindowController;
use App\Http\Controllers\PaintCanController;
use App\Http\Controllers\WallController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/paintWalls', [RoomController::class, 'paintWalls']);

Route::get('/door/info', [DoorController::class, 'info']);

Route::get('/window/info', [WindowController::class, 'info']);

Route::get('/paint-can/info', [PaintCanController::class, 'info']);

Route::get('/wall/rules', [WallController::class, 'rules']);