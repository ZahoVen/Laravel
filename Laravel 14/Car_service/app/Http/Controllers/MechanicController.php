<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;

class MechanicController extends Controller
{
    public function getCars($id)
    {
        $mechanic = Mechanic::find($id);

        if (!$mechanic) {
            // Ideally, you should create a custom error response here
            return response()->json(['message' => 'Mechanic not found'], 404);
        }

        $cars = $mechanic->cars;

        return response()->json($cars);
    }
}
