<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Area::factory()->createMany([
            ['name' => 'Mantenimiento de Exportación'],
            ['name' => 'Mantenimiento de Inyección'],
            ['name' => 'Mantenimiento General'],
        ]);
    }
}
