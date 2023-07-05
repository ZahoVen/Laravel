<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class CarNotFoundException extends Exception
{
    public function report()
    {
        Log::debug('Car not found');
    }

    public function render($request)
    {
        return response()->json([
            'error' => 'Car not found'
        ], 404);
    }
}
