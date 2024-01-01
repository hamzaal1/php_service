<?php
require_once '../core/autoload.php';
use App\Controller\AuthController;
use App\Route;


// _______________________________Auth Controller__________________________

Route::get('/is-auth',AuthController::class,'isAuth');
Route::post('/logout',AuthController::class,'logout');
Route::post('/login',AuthController::class,'auth');
Route::post('/create',AuthController::class,'create');
