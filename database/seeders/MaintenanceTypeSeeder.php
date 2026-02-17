<?php

namespace Database\Seeders;

use App\Models\MaintenanceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaintenanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaintenanceType::factory()->createMany([
            ['name' => 'Correctivo'],
            ['name' => 'Preventivo'],
            ['name' => 'Cambio de molde'],
            ['name' => 'Cambio de troquel'],
        ]);
    }
}
