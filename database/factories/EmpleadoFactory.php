<?php

namespace Database\Factories;

use App\Models\Pais;
use App\Models\Ciudad;
use App\Models\Provincia;
use App\Models\Departamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'apellido' => $this->faker->lastName(),
            'nombre' => $this->faker->firstName(),
            'nombre_medio' => $this->faker->firstName(),
            'direccion' => $this->faker->address(),
            'id_pais' => function () {
                return Pais::factory()->create()->id;
            },
            'id_provincia' => function () {
                return Provincia::factory()->create()->id;
            },
            'id_departamento' => function () {
                return Departamento::factory()->create()->id;
            },
            'id_ciudad' => function () {
                return Ciudad::factory()->create()->id;
            },
            'codigo_postal' => $this->faker->postcode(),
            'fecha_nacimiento' => date($format = 'Y-m-d'),
            'fecha_contratacion' => date($format = 'Y-m-d')
        ];
    }
}
