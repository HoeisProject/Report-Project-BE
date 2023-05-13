<?php

namespace App\Exceptions;

use App\Http\Controllers\ReportStatusController;
use App\Http\Controllers\RoleController;
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
        });
        $this->renderable(function (NotFoundHttpException $e, Request $req) {
            if ($req->is('*/' . RoleController::route . '/*'))
                return $this->notFound('Role data not found');
        });
    }
}
