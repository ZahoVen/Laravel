<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'make' => $this->faker->randomElement(['Toyota', 'Honda', 'Ford', 'BMW', 'Mercedes']),
            'model' => $this->faker->randomElement(['Model 1', 'Model 2', 'Model 3', 'Model 4', 'Model 5']),
            'owner_id' => null,
            'mechanic_id' => null,
        ];
    }
}
