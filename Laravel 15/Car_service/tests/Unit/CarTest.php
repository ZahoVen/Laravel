<?php

namespace Tests\Unit;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarTest extends TestCase
{
    use RefreshDatabase;

    public function testCarCanBeCreated()
    {
        Car::create([
            'make' => 'Toyota',
            'model' => 'Corolla',
            'owner_id' => 1,
            'mechanic_id' => 1
        ]);

        $this->assertCount(1, Car::all());
    }
}
