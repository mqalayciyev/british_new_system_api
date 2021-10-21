<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Company::create([
        //     'name' => 'British Centre',
        //     'email' => 'mqalayciyev@mail.ru',
        //     'mobile' => '+994514598208',
        //     'status' => '1',
        // ]);


        User::create([
            'first_name' => 'Mehemmed',
            'last_name' => 'Qalayciyev',
            'email' => 'mqalayciyev@mail.ru',
            'mobile' => '+994514598208',
            'password' => Hash::make('12345678'),
            'type' => '1',
            'status' => '1',
            'company' => '1',
        ]);
    }
}
