<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightTarget;

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
