<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_nro' => rand(10000000,1199999999),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress(),
            'city_id' => rand(1, 13),
            'client_type' => rand(0,1) ? 'Prospecto': 'Cliente',
            'id_type' => rand(1,3),
        ];
    }


}//class
