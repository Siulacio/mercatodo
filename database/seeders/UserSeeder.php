<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::create([
            'name' => 'admin',
            'last_name' => 'admin',
            'identification' => '123',
            'address' => 'admin address',
            'phone' => '3003003000',
            'email' => 'admin@example.com',
            'email_verified_at' => date('Y-m-s H:m:s'),
            'role' => 'admin',
            'password' => bcrypt('123'),
        ]);


        $standarUser = User::create([
            'name' => 'standar',
            'last_name' => 'standar',
            'identification' => '321',
            'address' => 'standar address',
            'phone' => '3003003000',
            'email' => 'standar@example.com',
            'email_verified_at' => date('Y-m-s H:m:s'),
            'role' => 'standar',
            'password' => bcrypt('123'),
        ]);
    }
}
