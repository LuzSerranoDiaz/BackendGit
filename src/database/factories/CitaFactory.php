<?php

namespace Database\Factories;

use App\Models\CitaServicio;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Empleado;
use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cita>
 */
class CitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $clientes = Cliente::pluck('id')->toArray();
        $cliente_id = fake()->randomElement($clientes);
        $empleados = Empleado::pluck('id')->toArray();
        $empleado_id = fake()->randomElement($empleados);
       /*  $contratos = Contrato::pluck('id')->toArray();
        $contrato_id = fake()->randomElement($contratos);
        $contrato_id = Contrato::where('cliente_id', '=', strval(array_search($cliente_id, $contratos, true))); */
        /* $contrato_id = Contrato::find($cliente_id)->id; */ /* Al haber solo un contrato por cliente tienen el mismo id */
       /*  $contrato = Contrato::where('cliente_id', '=', $cliente_id)->get();
        $contrato_Id = Contrato::where('cliente_id', '=', $cliente_id)->value('id'); */

        $inicio = Carbon::createFromTime(8)->addMinutes(fake()->numberBetween(0, 540)); // Entre 8:00 y 17:00
        $duracion = fake()->randomElement([15, 30, 60]);
        $fin = (clone $inicio)->addMinutes($duracion);

        return [
            /* 'cliente_id' => $cliente_id,
            'empleado_id' => $empleado_id,
            'contrato_id' => $cliente_id,
            'fecha' => fake()->unique()->dateTime(),
            'estado' => fake()->randomElement(['pendiente', 'cancelado', 'completado']),
            'numero_de_atenciones' => 1, */
            'cliente_id' => Cliente::inRandomOrder()->first()->id ?? Cliente::factory(),
            'empleado_id' => Empleado::inRandomOrder()->first()->id ?? Empleado::factory(),
            'fecha' => fake()->dateTimeBetween('now', '+10 days')->format('Y-m-d'),
            'hora_inicio' => $inicio->format('H:i'),
            'hora_fin' => $fin->format('H:i'),
            'estado' => 'pendiente',
        ];
    }
}
