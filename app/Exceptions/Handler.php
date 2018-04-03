<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Traits\ExceptionTrait;
use App\Traits\ResultTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{

    use ExceptionTrait, ResultTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // dd($exception);
        if(env('APP_DEBUG') == true){
            dd($exception);
        }
        if( $exception instanceof ValidationException ) {
            return parent::render($request, $exception);
        }
        if( $exception instanceof AuthenticationException){
            return parent::render($request, $exception);
        }

        if( $exception instanceof NotFoundHttpException){
            return redirect('notfound');
        }

        if( request()->ajax() ) {
            $results = array_merge($this->results, [
                'message' => $this->handler($exception)
            ]);

            return response()->json($results);
        } else {
            abort(404, $this->handler($exception));
        }
    }
}
