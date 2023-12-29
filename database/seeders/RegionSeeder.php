<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    public function run()
    {
        $regions = [
            ['description' => 'Aguascalientes'],
            ['description' => 'Baja California'],
            ['description' => 'Baja California Sur'],
            ['description' => 'Campeche'],
            ['description' => 'Chiapas'],
            ['description' => 'Chihuahua'],
        ];

        foreach ($regions as $region) {
            DB::table('regions')->insert($region);
        }
    }
}
