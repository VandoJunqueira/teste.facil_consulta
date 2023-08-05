<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
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

// Login
Route::post('/login', [AuthController::class, 'authenticate']);
// Route::get('/login', [AuthController::class, 'authenticate']);

// Listar cidades
Route::get('/cidades', [CityController::class, 'index']);

// Listar médicos de uma cidade
Route::get('/cidades/{city_id}/medicos', [CityController::class, 'doctors']);

// Listar médicos
Route::get('/medicos', [DoctorController::class, 'index']);

### Rotas com autenticação ###
Route::middleware('auth:api')->group(function () {

    // Listar médicos
    Route::post('/medicos', [DoctorController::class, 'store']);

    // Vincular paciente e médico
    Route::post('/medicos/{doctor_id}/pacientes', [DoctorController::class, 'storePatient']);

    // Listar pacientes do médico
    Route::get('/medicos/{doctor_id}/pacientes', [DoctorController::class, 'patients']);

    // Atualizar paciente
    Route::put('/pacientes/{patient_id}', [PatientController::class, 'update']);

    // Adicionar paciente
    Route::post('/pacientes', [PatientController::class, 'store']);

    // AuthController
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user', [AuthController::class, 'me']);
});
