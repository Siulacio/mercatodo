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
        $user = User::create([
            'name' => 'admin',
            'last_name' => 'admin',
            'identification' => '123',
            'address' => 'admin address',
            'phone' => '3003003000',
            'email' => 'admin@example.com',
            'email_verified_at' => date('Y-m-s H:m:s'),
            'password' => bcrypt('123'),
        ]);
    }
}
