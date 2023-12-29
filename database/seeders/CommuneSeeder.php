<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommuneSeeder extends Seeder
{
    public function run()
    {
        $communes = [
            // Aguascalientes
            ['id_reg' => 1, 'description' => 'Aguascalientes'],
            ['id_reg' => 1, 'description' => 'Jesús María'],
            ['id_reg' => 1, 'description' => 'Calvillo'],
            ['id_reg' => 1, 'description' => 'Rincón de Romos'],
            ['id_reg' => 1, 'description' => 'San José de Gracia'],
            ['id_reg' => 1, 'description' => 'Tepezalá'],
            // Baja California
            ['id_reg' => 2, 'description' => 'Ensenada'],
            ['id_reg' => 2, 'description' => 'Mexicali'],
            ['id_reg' => 2, 'description' => 'Tijuana'],
            ['id_reg' => 2, 'description' => 'Rosarito'],
            ['id_reg' => 2, 'description' => 'Tecate'],
            ['id_reg' => 2, 'description' => 'Playas de Rosarito'],
            // Baja California Sur
            ['id_reg' => 3, 'description' => 'La Paz'],
            ['id_reg' => 3, 'description' => 'Cabo San Lucas'],
            ['id_reg' => 3, 'description' => 'San José del Cabo'],
            ['id_reg' => 3, 'description' => 'Comondú'],
            ['id_reg' => 3, 'description' => 'Loreto'],
            ['id_reg' => 3, 'description' => 'Mulegé'],
            // Campeche
            ['id_reg' => 4, 'description' => 'Campeche'],
            ['id_reg' => 4, 'description' => 'Ciudad del Carmen'],
            ['id_reg' => 4, 'description' => 'Champotón'],
            ['id_reg' => 4, 'description' => 'Escárcega'],
            ['id_reg' => 4, 'description' => 'Hopelchén'],
            ['id_reg' => 4, 'description' => 'Tenabo'],
            // Chiapas
            ['id_reg' => 5, 'description' => 'Tuxtla Gutiérrez'],
            ['id_reg' => 5, 'description' => 'Tapachula'],
            ['id_reg' => 5, 'description' => 'San Cristóbal de las Casas'],
            ['id_reg' => 5, 'description' => 'Venustiano Carranza'],
            ['id_reg' => 5, 'description' => 'Palenque'],
            ['id_reg' => 5, 'description' => 'Comitán de Domínguez'],
            // Chihuahua
            ['id_reg' => 6, 'description' => 'Chihuahua'],
            ['id_reg' => 6, 'description' => 'Juárez'],
            ['id_reg' => 6, 'description' => 'Cuauhtémoc'],
            ['id_reg' => 6, 'description' => 'Delicias'],
            ['id_reg' => 6, 'description' => 'Parral'],
            ['id_reg' => 6, 'description' => 'Nuevo Casas Grandes'],
            // Agrega más comunas según sea necesario
        ];

        foreach ($communes as $commune) {
            DB::table('communes')->insert($commune);
        }
    }
}
