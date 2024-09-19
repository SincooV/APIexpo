<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\presenceController;
use App\Http\Controllers\classController;





Route::apiResource('/presentes', presenceController::class);
Route::apiResource('/users', StudentController::class );
Route::apiResource('/turmas', classController::class );
Route::patch('/user/{id}', [StudentController::class, 'patch' ]);
Route::put('/users/{id}', [StudentController::class, 'update' ]);  
Route::post('/presentes/search/{turmaName}', [presenceController::class, 'storePresence']);
Route::post('/user', [StudentController::class, 'store']);
Route::get('/turmas/search/{id}', [classController::class, 'searchByTurma' ]);
Route::get('/turmas/by-aluno/{id}', [classController::class, 'searchByAluno']);
Route::middleware('throttle:api')->group(function () {
    Route::post('/login', [StudentController::class, 'login']);
    Route::post('/logout', [StudentController::class, 'logout'])->middleware('auth:sanctum');
});
