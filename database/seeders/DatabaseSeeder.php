<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // \App\Models\User::factory(10)->create();

         // Create user
         \App\Models\User::factory()->create([
            'name' => 'Wilver Leal',
            'email' => 'wilver@leal.com',
            'password' => bcrypt('12345678'),

        ]);

        // Create user 2
        \App\Models\User::factory()->create([
            'name' => 'Regular',
            'email' => '12345678',
            'password' => bcrypt('12345678'),
        ]);
    }
}
