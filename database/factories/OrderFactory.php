<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    //crerate name of order
    public function definition()
    {
        return [
            'name'            => $this->faker->bothify('?###??##'),
            'full_name'       => $this->faker->name,
            'company_id'      => Company::all()->random()->id,
            'user_id'         => User::all()->random()->id,
            'payment_type_id' => PaymentType::all()->random()->id,
            'address'         => $this->faker->streetAddress,
            'status'          => $this->faker->boolean(),
            'country'         => $this->faker->country(),
            'city'            => $this->faker->city(),
            'total'           => $this->faker->randomFloat(3, 0, 1000),
            'reste'           => $this->faker->randomFloat(3, 0, 1000),
        ];
    }
}
