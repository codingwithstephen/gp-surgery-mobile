<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\MedicalRecordController;
use App\Http\Controllers\Api\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Patient routes
    Route::apiResource('patients', PatientController::class);
    
    // Doctor routes
    Route::apiResource('doctors', DoctorController::class);
    
    // Appointment routes
    Route::apiResource('appointments', AppointmentController::class);
    
    // Medical Record routes
    Route::apiResource('medical-records', MedicalRecordController::class);
});
