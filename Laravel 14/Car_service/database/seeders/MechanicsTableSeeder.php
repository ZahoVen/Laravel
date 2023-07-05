<?php

namespace Database\Seeders;

use App\Models\Mechanic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MechanicsTableSeeder extends Seeder
{
    public function run()
    {
        Mechanic::factory()->count(20)->create();
    }
}
