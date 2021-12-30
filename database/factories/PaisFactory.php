<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo_pais' => $this->faker->countryCode(),
            'nombre' => $this->faker->country()
        ];
    }
}
