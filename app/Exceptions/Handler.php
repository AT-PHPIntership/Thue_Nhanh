<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use App\Exceptions\InvalidConfirmationCodeException;
use App\Exceptions\UnauthorizedException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $e the exception to be reported
     *
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request the application request
     * @param \Exception               $e       the exception to be rendered
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        switch ($e) {
            case ($e instanceof InvalidConfirmationCodeException):
                return $this->renderException($e);
                break;

            case ($e instanceof UnauthorizedException):
                return $this->renderException($e);
                break;

            default:
                return parent::render($request, $e);
        }
    }

    /**
     * Render the exception.
     *
     * @param Exception $e the exception to be rendered
     *
     * @return Response
     */
    public function renderException($e)
    {
        switch ($e) {
            case ($e instanceof InvalidConfirmationCodeException):
                return view('errors.404');
                break;

            case ($e instanceof UnauthorizedException):
                return view('errors.401');
                break;

            default:
                return (new SymfonyDisplayer(config('app.debug')))->createResponse($e);
        }
    }
}
