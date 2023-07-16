<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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




Route::post('/user/create', [\App\Http\Controllers\UserController::class, 'create']);
Route::post('/user/login', [\App\Http\Controllers\UserController::class, 'login']);
Route::get('/user/show', [\App\Http\Controllers\UserController::class, 'show']);


Route::post('/add-treatment', [\App\Http\Controllers\TreatmentController::class, 'store']);
Route::post('/add-reception', [\App\Http\Controllers\ReceptionController::class, 'store']);
Route::get('/treatment-amount/{treatment_id}', [\App\Http\Controllers\KitController::class, 'kitAmount']);

Route::post('/add-note', [\App\Http\Controllers\NoteController::class, 'store']);
Route::post('/add-appointment', [\App\Http\Controllers\AppointmentController::class, 'store']);
Route::post('/add-question', [\App\Http\Controllers\QuestionController::class, 'store']);
