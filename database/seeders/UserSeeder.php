<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
             'name' => 'Wilver Leal',
             'email' => 'wilver@leal.com',
             'password' => bcrypt('12345678'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Herramentero',
            'email' => 'herramentero@sena.com',
            'password' => bcrypt('12345678'),
       ])->assignRole('Regular');

        // \App\Models\User::factory()->create([
        //     'name' => 'Wilver Leal',
        //     'email' => 'wilver@leal.com',
        //     'password' => bcrypt('12345678'),
        // ])->assignRole('Admin');
    }
}
