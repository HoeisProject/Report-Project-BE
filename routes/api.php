<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DevToolController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportStatusController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('ping', [DevToolController::class, 'ping']);

/// Authentication
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


// Protected Routes - Only authenticated
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('ping-authorize', [DevToolController::class, 'pingAuthorize']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('current-user', [AuthController::class, 'currentUser']);

    Route::apiResource(UserController::route, UserController::class)->except('store');
    Route::post('user-verify', [UserController::class, 'verify']);

    Route::apiResource(ProjectController::route, ProjectController::class);
    Route::post(ProjectController::route . '/{id}/restore', [ProjectController::class, 'restore']);

    Route::apiResource(ReportController::route, ReportController::class);
    Route::post(ReportController::route . '/{id}/restore', [ReportController::class, 'restore']);

    Route::apiResource(ReportStatusController::route, ReportStatusController::class);

    Route::apiResource(RoleController::route, RoleController::class);
});

// 405 = Method Not Allowed
