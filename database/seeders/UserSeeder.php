<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert(
            [
                ['username' => 'admin', 'email' => 'admin@sample.com', 'password' => bcrypt('admin'), 'created_at' => now(), 'updated_at' => now()],
                ['username' => 'admin2', 'email' => 'admin2@sample.com', 'password' => bcrypt('admin'), 'created_at' => now(), 'updated_at' => now()]
            ],
        );
    }
}
