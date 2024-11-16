<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
        ];

        foreach ($userData as $user) {
            User::create($user);
        }
    }
}
