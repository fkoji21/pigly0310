<?php

namespace Database\Seeders;

use App\Models\WeightTarget;
use Illuminate\Database\Seeder;

class WeightTargetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WeightTarget::factory()->create();
    }
}
