<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Servicio::factory()->create([
            'nombre' => 'corte', 
            'duracion' => '30', 
            'precio' => '15'
        ]);
        Servicio::factory()->create([
            'nombre' => 'peinado', 
            'duracion' => '15', 
            'precio' => '20'
        ]);
        Servicio::factory()->create([
            'nombre' => 'tinte', 
            'duracion' => '60', 
            'precio' => '50'
        ]);
    }
}
