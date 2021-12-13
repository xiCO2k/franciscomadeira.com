<?php
// @codeCoverageIgnoreStart

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e)
    {
        /** @var \Illuminate\Http\Response $response */
        $response = parent::render($request, $e);

        if ($response->status() === 419) {
            return back()->with([
                'message' => 'The page expired, please try again.',
            ]);
        }

        if (! in_array($response->status(), [500, 503, 404, 403])) {
            return $response;
        }

        return Inertia::render('Error', ['status' => $response->status()])
            ->toResponse($request)
            ->setStatusCode($response->status());
    }
}
