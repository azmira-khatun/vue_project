<?php



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::apiResource('roles', RoleController::class);


// Units CRUD API endpoint
Route::apiResource('units', UnitController::class);
// routes/api.php
Route::apiResource('categories', CategoryController::class);
