<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat satu pengguna dengan peran admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Pastikan password yang aman
            'role' => 'admin',
        ]);

        // Membuat lima pengguna biasa
        $users = [
            [
                'name' => 'User One',
                'email' => 'user1@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'name' => 'User Two',
                'email' => 'user2@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'name' => 'User Three',
                'email' => 'user3@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'name' => 'User Four',
                'email' => 'user4@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'name' => 'User Five',
                'email' => 'user5@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
