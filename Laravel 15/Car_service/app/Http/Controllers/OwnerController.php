<?php

namespace App\Http\Controllers;

use App\Models\Owner;

class OwnerController extends Controller
{
    public function getCars($id)
    {
        $owner = Owner::find($id);

        if (!$owner) {
            return response()->json(['message' => 'Owner not found'], 404);
        }

        $cars = $owner->cars;

        return response()->json($cars);
    }
}
