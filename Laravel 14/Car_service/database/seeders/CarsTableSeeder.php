<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\Owner;
use App\Models\Mechanic;

class CarsTableSeeder extends Seeder
{
    public function run()
    {
        Car::factory()->count(100)->create()->each(function ($car) {
            $car->owner_id = Owner::all()->random()->id;
            $car->mechanic_id = Mechanic::all()->random()->id;
            $car->save();
        });
    }
}
