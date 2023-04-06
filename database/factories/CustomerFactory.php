<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name(),
            'address' =>  $this->faker->address(),
            'phone' =>  $this->faker->address(),
            'date_of_birth' =>  $this->faker->date(),
            'gender' =>  $this->faker->randomElement(['male','female'])
        ];
    }
}
