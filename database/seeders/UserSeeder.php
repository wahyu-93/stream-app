<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name'  => 'admin',
            'email' => 'admin@stream.com',
            'password' => Hash::make('admin123'),
            'phone_number' => '082250931217',
            'avatar' => '',
            'role' => 'admin'
        ]);
    }
}
