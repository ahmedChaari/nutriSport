<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name'          =>   'nutriweb.mc',
            'role'      =>   1,
            ]);
        Company::create([
            'name'          =>   'nutriweb.fr',
            'role'      =>   2,
            ]);
        Company::create([
            'name'          =>   'nutriweb.uk',
            'role'      =>   2,
            ]);
    }
}
