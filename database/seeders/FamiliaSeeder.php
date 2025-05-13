<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FamiliaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $familias = [
            'Informàtica i comunicacions',
            'Administració i gestió',
            'Sanitat',
            'Serveis socioculturals i a la comunitat',
            'Electricitat i electrònica',
            'Imatge i so',
            'Hostaleria i Turisme',
            'Fabricació mecànica',
            'Comerç i màrqueting',
            'Altres'
        ];

        $now = Carbon::now();

        foreach ($familias as $familia) {
            DB::table('familias')->insert([
                'nombre' => $familia,
                'descripcion' => 'Descripción de la familia profesional ' . $familia,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
} 