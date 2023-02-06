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
            'name'      => 'nutriweb.mc',
            'email'     => 'contact@mindcom.ma',
            'role'      =>  1,
            ]);
        Company::create([
            'name'      => 'nutriweb.fr',
            'email'     => 'fr.contact@mindcom.ma',
            'role'      =>   2,
            ]);
        Company::create([
            'name'       => 'nutriweb.uk',
            'email'      => 'uk.contact@mindcom.ma',
            'role'       =>   2,
            ]);
    }
}
