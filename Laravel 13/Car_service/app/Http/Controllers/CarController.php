<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Exceptions\CarNotFoundException;

class CarController extends Controller
{
    public function show($id)
    {
        $car = Car::find($id);

        if (!$car) {
            throw new CarNotFoundException();
        }

        return response()->json($car);
    }
}
