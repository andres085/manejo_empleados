<?php

namespace Database\Factories;

use App\Models\Provincia;
use Illuminate\Database\Eloquent\Factories\Factory;

class CiudadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'provincia_id' => function () {
                return Provincia::factory()->create()->id;
            },
            'nombre' => $this->faker->city(),
        ];
    }
}
