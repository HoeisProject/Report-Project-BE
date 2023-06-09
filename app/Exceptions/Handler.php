<?php

namespace App\Exceptions;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectPriorityController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportMediaController;
use App\Http\Controllers\ReportStatusController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Traits\HttpResponses;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use HttpResponses;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // https://laraveldaily.com/post/laravel-api-override-404-error-message-route-model-binding
        $this->renderable(function (NotFoundHttpException $e, Request $req) {
            if ($req->is('*/' . ReportStatusController::route . '/*'))
                return $this->notFound('Report status data not found');
            if ($req->is('*/' . RoleController::route . '/*'))
                return $this->notFound('Role data not found');
            if ($req->is('*/' . ProjectController::route . '/*'))
                return $this->notFound('Project data not found');
            if ($req->is('*/' . UserController::route . '/*'))
                return $this->notFound('User data not found');
            if ($req->is('*/' . ReportController::route . '/*'))
                return $this->notFound('report data not found');
            if ($req->is('*/' . ReportMediaController::route . '/*'))
                return $this->notFound('report media data not found');
            if ($req->is('*/' . ProjectPriorityController::route . '/*'))
                return $this->notFound('project priority data not found');
        });
    }
}
