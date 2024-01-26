<?php

namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        $rol1 = Role::create(['name' => 'Admin']);
        $rol2 = Role::create(['name' => 'Regular']);

        Permission::create(['name' => 'home'])->syncRoles([$rol1, $rol2]);

        Permission::create(['name' => 'herramienta.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'herramienta.edit'])->syncRoles([$rol1]);
        Permission::create(['name' => 'herramienta.create'])->syncRoles([$rol1]);
        Permission::create(['name' => 'herramienta.msg'])->syncRoles([$rol1]);
        Permission::create(['name' => 'herramienta.destroy'])->syncRoles([$rol1]);

        Permission::create(['name' => 'matConsumible.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'matConsumible.edit'])->syncRoles([$rol1]);
        Permission::create(['name' => 'matConsumible.create'])->syncRoles([$rol1]);
        Permission::create(['name' => 'matConsumible.msg'])->syncRoles([$rol1]);
        Permission::create(['name' => 'matConsumible.destroy'])->syncRoles([$rol1]);

        Permission::create(['name' => 'prestamo.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'prestamo.edit'])->syncRoles([$rol1], $rol2);
        Permission::create(['name' => 'prestamo.create'])->syncRoles([$rol1], $rol2);
        Permission::create(['name' => 'prestamo.msg'])->syncRoles([$rol1], $rol2);
        Permission::create(['name' => 'prestamo.destroy'])->syncRoles([$rol1]);

        Permission::create(['name' => 'registro.index'])->syncRoles([$rol1, $rol2]);
        // Permission::create(['name' => 'registro.create'])->syncRoles([$rol1]);
        // $rol1->givePermissionTo(['herramienta.edit', 'herramienta.create', 'herramienta.msg', 'herramienta.destroy'
        // ,'matConsumible.edit', 'matConsumible.create', 'matConsumible.msg', 'matConsumible.destroy']);
    }
}
