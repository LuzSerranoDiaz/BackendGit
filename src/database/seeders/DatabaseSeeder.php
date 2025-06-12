<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\CitaServicio;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Empleado;
use App\Models\EmpleadoEspecilidad;
use App\Models\Especialidad;
use App\Models\Servicio;
use App\Models\Usuario;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Usuario::factory()->create([
            'email' => 'admin@admin.com', 
            'contrasena' =>  bcrypt('vzcRZ2bt') , 
            'nombre' => 'admin', 
            'nombreUsuario' => 'admin', 
            'isAdmin' => 1
        ]);
        Usuario::factory(10)->has(
            Cliente::factory()->has(
                Contrato::factory()
            )
        )->create();
        Especialidad::factory()->create(['nombre' => 'cortar']);
        Especialidad::factory()->create(['nombre' => 'tintar']);
        Especialidad::factory()->create(['nombre' => 'degradar']);
        Usuario::factory(3)->has(
            Empleado::factory()
        )->create();
        EmpleadoEspecilidad::factory(3)->create();
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
        Cita::factory(100)->create()->each(function ($cita) {
            // Adjunta entre 1 y 3 servicios aleatorios
            $servicios = Servicio::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $cita->servicios()->attach($servicios);
        });
        /* Cita::factory(100)->create();
        CitaServicio::factory(random_int(200, 500))->create(); */
    }
}
