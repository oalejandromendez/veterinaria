<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Crear rol y asignar permisos admin de programa
         $role = Role::create(['name' => 'ADMINISTRADOR']);

         $role->givePermissionTo([
             'ACCEDER_USUARIOS',
             'VER_USUARIOS',
             'CREAR_USUARIOS',
             'MODIFICAR_USUARIOS',
             'ELIMINAR_USUARIOS',
             'ACCEDER_ANIMALES',
             'VER_ANIMALES',
             'CREAR_ANIMALES',
             'MODIFICAR_ANIMALES',
             'ELIMINAR_ANIMALES',
             'ACCEDER_RESPONSABLES',
             'VER_RESPONSABLES',
             'CREAR_RESPONSABLES',
             'MODIFICAR_RESPONSABLES',
             'ELIMINAR_RESPONSABLES',

         ]);
        Role::create(['name' => 'VETERINARIO']);
        Role::create(['name' => 'RECEPCIONISTA']);

    }
}
