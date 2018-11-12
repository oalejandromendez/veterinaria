<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');
        //Permisos Acceso mudulo
        Permission::create(['name' => 'SUPERADMINISTRADOR']);
        Permission::create(['name' => 'ACCEDER_USUARIOS']);
        Permission::create(['name' => 'VER_USUARIOS']);
        Permission::create(['name' => 'CREAR_USUARIOS']);
        Permission::create(['name' => 'MODIFICAR_USUARIOS']);
        Permission::create(['name' => 'ELIMINAR_USUARIOS']);

        Permission::create(['name' => 'ACCEDER_ANIMALES']);
        Permission::create(['name' => 'VER_ANIMALES']);
        Permission::create(['name' => 'CREAR_ANIMALES']);
        Permission::create(['name' => 'MODIFICAR_ANIMALES']);
        Permission::create(['name' => 'ELIMINAR_ANIMALES']);

        Permission::create(['name' => 'ACCEDER_RESPONSABLES']);
        Permission::create(['name' => 'VER_RESPONSABLES']);
        Permission::create(['name' => 'CREAR_RESPONSABLES']);
        Permission::create(['name' => 'MODIFICAR_RESPONSABLES']);
        Permission::create(['name' => 'ELIMINAR_RESPONSABLES']);

        Permission::create(['name' => 'ACCEDER_EPICRISIS']);
        Permission::create(['name' => 'VER_EPICRISIS']);
        Permission::create(['name' => 'CREAR_EPICRISIS']);
        Permission::create(['name' => 'MODIFICAR_EPICRISIS']);
        Permission::create(['name' => 'ELIMINAR_EPICRISIS']);
        
        Permission::create(['name' => 'ACCEDER_ESTADOS']);
        Permission::create(['name' => 'VER_ESTADOS']);
        Permission::create(['name' => 'MODIFICAR_ESTADOS']);

    }
}
