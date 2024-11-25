<?php

namespace Database\Factories;

use TechChallenge\Infra\DB\Eloquent\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'cpf' => $this->faker->numerify('###########'), // Gera um CPF fictício
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
