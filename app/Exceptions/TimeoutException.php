<?php

namespace App\Exceptions;

use Exception;

class TimeoutException extends Exception
{
    public function render($request)
    {
        return response()->view('errors.timeout', [], 500);
    }
}
