<?php

namespace Database\Factories;

use App\Models\Mechanic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mechanic>
 */
class MechanicFactory extends Factory
{
    protected $model = Mechanic::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
