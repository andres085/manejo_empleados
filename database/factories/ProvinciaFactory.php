<?php

namespace Database\Factories;

use App\Models\Pais;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProvinciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pais_id' => function () {
                return Pais::factory()->create()->id;
            },
            'nombre' => $this->faker->state
        ];
    }
}
