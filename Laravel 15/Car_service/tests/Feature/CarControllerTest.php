<?php

namespace Tests\Feature;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCarCanBeRetrieved()
    {
        $car = Car::create([
            'make' => 'Toyota',
            'model' => 'Corolla',
            'owner_id' => 1,
            'mechanic_id' => 1
        ]);

        $response = $this->get('/api/cars/' . $car->id);

        $response->assertStatus(200);
        $response->assertJson(['id' => $car->id, 'make' => 'Toyota', 'model' => 'Corolla']);
    }
}
