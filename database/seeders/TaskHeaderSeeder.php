<?php

namespace Database\Seeders;

use App\Models\TaskHeader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskHeader::factory()->createMany([
            ['name' => 'Chiller York'],
            ['name' => 'Chiller Resplado'],
            ['name' => 'Compresor Kaeser 20HP'],
            ['name' => 'Compresor Sulliar 50 HP'],
            ['name' => 'Subestación eléctrica'],
            ['name' => 'Hotmelt #4'],
            ['name' => 'Hotmelt #1'],
            ['name' => 'Hotmelt #3'],
            ['name' => 'Hotmelt #2'],
            ['name' => 'WOOJIN 160 - General'],
            ['name' => 'WOOJIN 160 - Semestral'],
            ['name' => 'WOOJIN 160 - Anual'],
            ['name' => 'WOOJIN 280 - General'],
            ['name' => 'WOOJIN 280 - Semestral'],
            ['name' => 'WOOJIN 280 - Anual'],
            ['name' => 'WOOJIN 380-1 - General'],
            ['name' => 'WOOJIN 380-1 - Semestral'],
            ['name' => 'WOOJIN 380-1 - Anual'],
            ['name' => 'WOOJIN 380-2 - General'],
            ['name' => 'WOOJIN 380-2 - Semestral'],
            ['name' => 'WOOJIN 380-2 - Anual'],
            ['name' => 'NISSEI 5000 - General'],
            ['name' => 'NISSEI 5000 - Semestral'],
            ['name' => 'NISSEI 5000 - Anual'],
            ['name' => 'NISSEI 6000 - General'],
            ['name' => 'NISSEI 6000 - Semestral'],
            ['name' => 'NISSEI 6000 - Anual'],
            ['name' => 'FVX860 - General'],
            ['name' => 'FVX860 - Semestral'],
            ['name' => 'FVX860 - Anual'],
            ['name' => 'Molino 1 - General'],
            ['name' => 'Molino 1 - Semestral'],
            ['name' => 'Molino 2 - General'],
            ['name' => 'Molino 2 - Semestral'],
            ['name' => 'Molino 3 - General'],
            ['name' => 'Molino 3 - Semestral'],
            ['name' => 'Molino 4 - General'],
            ['name' => 'Molino 4 - Semestral'],
            ['name' => 'Lámparas de emergencia '],
            ['name' => 'Montacargas'],
            ['name' => 'Chevy'],
            ['name' => 'Baños de Hombre'],
            ['name' => 'Baños de Mujeres'],
            ['name' => 'Troqueladoras - General'],
            ['name' => 'Troqueladoras - Anual'],
            ['name' => 'Sierras - General'],
            ['name' => 'Sierras - Anual'],
            ['name' => 'CONV'],
            ['name' => 'DEP'],
            ['name' => 'SUB-1'],
            ['name' => 'SUB-2'],
            ['name' => 'DED-1'],
            ['name' => 'DED-2'],
            ['name' => 'DED-3'],
            ['name' => 'Máquina Cortadora de Felpa'],
            ['name' => 'Mini Split Oficina Nave 2 PB'],
            ['name' => 'Emplayadora'],
            ['name' => 'Mini Split'],
            ['name' => 'Cortina Métalica Nave 1'],
            ['name' => 'Bombas - Sistema Contra Incendios'],
            ['name' => 'Bombas - Red vs. Incendios'],
            ['name' => 'Bombas - Accesorios'],
            ['name' => 'Troqueles'],
        ]);
    }
}
