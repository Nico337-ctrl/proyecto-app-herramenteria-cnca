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
        //roles creados para los usuarios (super admin y herramentero o 'regular')
        $rol1 = Role::create(['name' => 'Admin']);
        $rol2 = Role::create(['name' => 'Regular']);

        //permiso para pagina inicial
        Permission::create(['name' => 'home'])->syncRoles([$rol1, $rol2]);

        //permisos para paginas derivadas de inventario herramientas
        Permission::create(['name' => 'herramienta.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'herramienta.edit'])->syncRoles([$rol1]);
        Permission::create(['name' => 'herramienta.create'])->syncRoles([$rol1]);
        Permission::create(['name' => 'herramienta.msg'])->syncRoles([$rol1]);
        Permission::create(['name' => 'herramienta.destroy'])->syncRoles([$rol1]);
        Permission::create(['name' => 'herramienta.pdf'])->syncRoles([$rol1, $rol2]);


        //permisos para paginas derivadas de inventario materiales consumibles
        Permission::create(['name' => 'matConsumible.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'matConsumible.edit'])->syncRoles([$rol1]);
        Permission::create(['name' => 'matConsumible.create'])->syncRoles([$rol1]);
        Permission::create(['name' => 'matConsumible.msg'])->syncRoles([$rol1]);
        Permission::create(['name' => 'matConsumible.destroy'])->syncRoles([$rol1]);
        Permission::create(['name' => 'matConsumible.pdf'])->syncRoles([$rol1, $rol2]);

        //permisos para paginas derivadas de prestamos
        Permission::create(['name' => 'prestamo.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'prestamo.edit'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'prestamo.create'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'prestamo.msg'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'prestamo.destroy'])->syncRoles([$rol1]);
        Permission::create(['name' => 'prestamo.pdf'])->syncRoles([$rol1, $rol2]);

        //permisos para paginas derivadas de registros
        Permission::create(['name' => 'registro.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'registro.pdf'])->syncRoles([$rol1, $rol2]);


        //permisos para paginas derivadas de excels
        Permission::create(['name' => 'excel.import'])->syncRoles([$rol1]);
        Permission::create(['name' => 'excel.export'])->syncRoles([$rol1]);

        //permisos para paginas derivadas de reportes
        Permission::create(['name' => 'reporte.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'reporte.pdf'])->syncRoles([$rol1, $rol2]);

    }
}
