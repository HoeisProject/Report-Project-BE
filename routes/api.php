<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DevToolController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectPriorityController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportMediaController;
use App\Http\Controllers\ReportStatusController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyAdminAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('ping', [DevToolController::class, 'ping']);
Route::get(ProjectPriorityController::route . '/{projectId}/show', [ProjectPriorityController::class, 'show']);
Route::post(ProjectPriorityController::route, [ProjectPriorityController::class, 'store']);
Route::post(ProjectPriorityController::route . '/calculate', [ProjectPriorityController::class, 'saw']);
Route::get(ProjectPriorityController::route . '/time-span', [ProjectPriorityController::class, 'timeSpan']);
Route::get(ProjectPriorityController::route . '/money-estimate', [ProjectPriorityController::class, 'moneyEstimate']);
Route::get(ProjectPriorityController::route . '/manpower', [ProjectPriorityController::class, 'manpower']);
Route::get(ProjectPriorityController::route . '/material-feasibility', [ProjectPriorityController::class, 'materialFeasibility']);

/// Authentication
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

/// Role
Route::get(RoleController::route, [RoleController::class, 'index']);
Route::get(RoleController::route . '/{role}', [RoleController::class, 'show']);

/// Dev Tool
Route::get('user-status-enum', [DevToolController::class, 'UserStatusEnum']);

// Protected Routes - Only authenticated
Route::group(['middleware' => ['auth:sanctum']], function () {

    /// Dev Tool
    Route::get('ping-authorize', [DevToolController::class, 'pingAuthorize']);

    /// Auth
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('current-user', [AuthController::class, 'currentUser']);

    /// User
    Route::apiResource(UserController::route, UserController::class)->except('index', 'store', 'destroy', 'update');
    Route::post('user-verify', [UserController::class, 'verify']);
    Route::post(UserController::route . '/update-properties', [UserController::class, 'updateProperties']);
    Route::middleware([OnlyAdminAction::class])->group(function () {
        Route::get(UserController::route, [UserController::class, 'index']);
        Route::put(UserController::route . '/{user}/update-status', [UserController::class, 'updateStatus']);
    });

    /// Project
    Route::apiResource(ProjectController::route, ProjectController::class)->except('store', 'update');
    Route::get(ProjectController::route . '/{id}/report', [ProjectController::class, 'report']);
    Route::post(ProjectController::route . '/{id}/restore', [ProjectController::class, 'restore']);
    Route::middleware([OnlyAdminAction::class])->group(function () {
        Route::post(ProjectController::route, [ProjectController::class, 'store']);
        Route::put(ProjectController::route . '/{id}', [ProjectController::class, 'update']);
    });

    /// Report
    Route::apiResource(ReportController::route, ReportController::class);
    Route::post(ReportController::route . '/{id}/restore', [ReportController::class, 'restore']);
    Route::put(ReportController::route . '/{report}/update-status', [ReportController::class, 'updateStatus']);
    Route::get(ReportController::route . '/{id}/report-media', [ReportController::class, 'reportMedia']);
    Route::get(ReportController::route . '/{userId}/user', [ReportController::class, 'user']);

    // Report Media
    Route::apiResource(ReportMediaController::route, ReportMediaController::class);
    Route::post(ReportMediaController::route . '/{id}/restore', [ReportMediaController::class, 'restore']);

    /// Report Status
    Route::apiResource(ReportStatusController::route, ReportStatusController::class);

    /// Role
    Route::apiResource(RoleController::route, RoleController::class)->except(['index', 'show']);
});

// 405 = Method Not Allowed

/*

$pagination = count($_SESSION["saw_cameras_5"][0]);

$offset = ($page-1) * $pagination;

$numbering = $i + $offset;

*/
