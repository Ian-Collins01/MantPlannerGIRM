<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Machine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inyeccionAreaId = Area::where('name', 'Mantenimiento de Inyección')->value('id');
        $exportAreaId = Area::where('name', 'Mantenimiento de Exportación')->value('id');
        $generalAreaId = Area::where('name', 'Mantenimiento General')->value('id');

        Machine::factory()->createMany([
            ['name' => 'ETC-1', 'area_id' => $exportAreaId],
            ['name' => 'ETC-2', 'area_id' => $exportAreaId],
            ['name' => 'ETC-3', 'area_id' => $exportAreaId],
            ['name' => 'ETC-4', 'area_id' => $exportAreaId],
            ['name' => 'DEP-1', 'area_id' => $exportAreaId],
            ['name' => 'DEP-2', 'area_id' => $exportAreaId],
            ['name' => 'DEP-3', 'area_id' => $exportAreaId],
            ['name' => 'DEP-4', 'area_id' => $exportAreaId],
            ['name' => 'ET-1', 'area_id' => $exportAreaId],
            ['name' => 'ET-2', 'area_id' => $exportAreaId],
            ['name' => 'ET-3', 'area_id' => $exportAreaId],
            ['name' => 'ET-4', 'area_id' => $exportAreaId],
            ['name' => 'ET-5', 'area_id' => $exportAreaId],
            ['name' => 'ET-6', 'area_id' => $exportAreaId],
            ['name' => 'ET-7', 'area_id' => $exportAreaId],
            ['name' => 'ET-8', 'area_id' => $exportAreaId],
            ['name' => 'ET-9', 'area_id' => $exportAreaId],
            ['name' => 'ET-10', 'area_id' => $exportAreaId],
            ['name' => 'ET-11', 'area_id' => $exportAreaId],
            ['name' => 'ET-12', 'area_id' => $exportAreaId],
            ['name' => 'ET-13', 'area_id' => $exportAreaId],
            ['name' => 'ET-14', 'area_id' => $exportAreaId],
            ['name' => 'ET-16', 'area_id' => $exportAreaId],
            ['name' => 'ET-17', 'area_id' => $exportAreaId],
            ['name' => 'ET-18', 'area_id' => $exportAreaId],
            ['name' => 'ET-19', 'area_id' => $exportAreaId],
            ['name' => 'ET-20', 'area_id' => $exportAreaId],
            ['name' => 'ET-21', 'area_id' => $exportAreaId],
            ['name' => 'ET-22', 'area_id' => $exportAreaId],
            ['name' => 'ET-23', 'area_id' => $exportAreaId],
            ['name' => 'ET-24', 'area_id' => $exportAreaId],
            ['name' => 'ET-25', 'area_id' => $exportAreaId],
            ['name' => 'ET-26', 'area_id' => $exportAreaId],
            ['name' => 'NT-1', 'area_id' => $exportAreaId],
            ['name' => 'NT-2', 'area_id' => $exportAreaId],
            ['name' => 'NT-3', 'area_id' => $exportAreaId],
            ['name' => 'NTU-1', 'area_id' => $exportAreaId],
            ['name' => 'FEL-1', 'area_id' => $exportAreaId],
            ['name' => 'DED-1', 'area_id' => $exportAreaId],
            ['name' => 'DED-2', 'area_id' => $exportAreaId],
            ['name' => 'DED-3', 'area_id' => $exportAreaId],
            ['name' => 'SUB-1', 'area_id' => $exportAreaId],
            ['name' => 'SUB-2', 'area_id' => $exportAreaId],
            ['name' => 'CONV-1', 'area_id' => $exportAreaId],
            ['name' => 'CONV-2', 'area_id' => $exportAreaId],
            ['name' => 'CONV-3', 'area_id' => $exportAreaId],
            ['name' => 'CONV-4', 'area_id' => $exportAreaId],
            ['name' => 'EUROINJ #1', 'area_id' => $inyeccionAreaId],
            ['name' => 'WOOJIN 280 #2', 'area_id' => $inyeccionAreaId],
            ['name' => 'NISSEI FN5000 #3', 'area_id' => $inyeccionAreaId],
            ['name' => 'Nissei FN6000 #4 ', 'area_id' => $inyeccionAreaId],
            ['name' => 'WOOJIN 380-1 #5', 'area_id' => $inyeccionAreaId],
            ['name' => 'WOOJIN 380-2 #6', 'area_id' => $inyeccionAreaId],
            ['name' => 'FVX 860 #7', 'area_id' => $inyeccionAreaId],
            ['name' => 'WOOJIN 160 #8', 'area_id' => $inyeccionAreaId],
            ['name' => 'Molino 1  ', 'area_id' => $inyeccionAreaId],
            ['name' => 'Molino 2   ', 'area_id' => $inyeccionAreaId],
            ['name' => 'Molino 3  ', 'area_id' => $inyeccionAreaId],
            ['name' => 'Molino 4 ', 'area_id' => $inyeccionAreaId],
            ['name' => 'CHILLER YORK', 'area_id' => $generalAreaId],
            ['name' => 'CHILLER RESPALDO', 'area_id' => $generalAreaId],
            ['name' => 'SULLIAR  COMPRESOR 50 HP', 'area_id' => $generalAreaId],
            ['name' => 'KAESER COMPRESOR 20 HP', 'area_id' => $generalAreaId],
            ['name' => 'MINI SPLIT OFICINAS PLANTA ALTA', 'area_id' => $generalAreaId],
            ['name' => 'MINI SPLIT OFICINAS PLANTA BAJA', 'area_id' => $generalAreaId],
            ['name' => 'MINI SPLIT COMEDOR', 'area_id' => $generalAreaId],
            ['name' => 'MINI SPLIT OFICINAS PLANTA ALTA 2', 'area_id' => $generalAreaId],
            ['name' => 'MINI SPLIT OFICINAS PLANTA BAJA 2', 'area_id' => $generalAreaId],
            ['name' => 'CHEVY', 'area_id' => $generalAreaId],
            ['name' => 'MONTACARGAS #1', 'area_id' => $generalAreaId],
            ['name' => 'MONTACARGAS #2', 'area_id' => $generalAreaId],
            ['name' => 'MONTACARGAS #3 ', 'area_id' => $generalAreaId],
            ['name' => 'MAQUINA DE HOTMELT #1', 'area_id' => $generalAreaId],
            ['name' => 'MAQUINA DE HOTMELT #2', 'area_id' => $generalAreaId],
            ['name' => 'MAQUINA DE HOTMELT #3', 'area_id' => $generalAreaId],
            ['name' => 'MAQUINA DE HOTMELT #4', 'area_id' => $generalAreaId],
            ['name' => 'EMPLAYADORA', 'area_id' => $generalAreaId],
            ['name' => 'BAÑOS PERSONAL PRODUCCION nave 1', 'area_id' => $generalAreaId],
            ['name' => 'BAÑOS PERSONAL PRODUCCION nave 2', 'area_id' => $generalAreaId],
            ['name' => 'BAÑOS OFICINAS nave 1', 'area_id' => $generalAreaId],
            ['name' => 'BAÑOS OFICINAS nave 2', 'area_id' => $generalAreaId],
            ['name' => 'SISTEMA CONTRA INCENDIO', 'area_id' => $generalAreaId],
            ['name' => 'SUB ESTACION', 'area_id' => $generalAreaId],
            ['name' => 'LAMPARAS DE EMERGENCIA', 'area_id' => $generalAreaId],
        ]);
    }
}
