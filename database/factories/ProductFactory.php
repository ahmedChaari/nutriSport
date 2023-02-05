<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Devise;
use App\Models\PaymentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'           => $this->faker->name,
          // 'company_id'     => Company::all()->random()->id,
            'devise_id'      => Devise::all()->random()->id,
           // 'price'          => $this->faker->randomFloat(3, 0, 1000),
            'stock_initial'  => $this->faker->numerify('###'),
            'available'      => $this->faker->boolean(),
        ];
    }
}
