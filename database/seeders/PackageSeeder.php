<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'  => 'standart',
                'price' => 380000,
                'max_days' => 30,
                'max_users' => 2,
                'is_download' => 1,
                'is_4k' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'  => 'gold',
                'price' => 699000,
                'max_days' => 60,
                'max_users' => 7,
                'is_download' => 1,
                'is_4k' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        
        Package::insert($data);
    }
}
