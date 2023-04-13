<?php

namespace Database\Seeders;

use App\Models\MasterJabatan;
use App\Models\User;
use App\Models\Customer;
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
     
        //Customer::factory(5)->create();
        MasterJabatan::create(['name' => 'Staff Administrasi']);
        MasterJabatan::create(['name' => 'Staff Keuangan']);
        User::factory(1)->create();

    }
}
