<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $rol1 = Role::create(['name' => 'Admin']);
        $rol2 = Role::create(['name' => 'Regular']);
        $usuario = \App\Models\User::find(1);
        $usuario->assignRole($rol1);
        $usuario = \App\Models\User::find(2);
        $usuario->assignRole($rol2);

    }
}
