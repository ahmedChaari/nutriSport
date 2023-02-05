<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            CompanySeeder::class,
            PaymentTypeSeeder::class,
            DeviseSeeder::class,
            UserSeeder::class,
            OrderSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
