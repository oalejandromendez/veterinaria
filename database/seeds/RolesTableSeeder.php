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
             'ACCEDER_EPICRISIS',
             'VER_EPICRISIS',
             'CREAR_EPICRISIS',
             'MODIFICAR_EPICRISIS',
             'ELIMINAR_EPICRISIS',
             'ACCEDER_ESTADOS',
             'VER_ESTADOS',
             'MODIFICAR_ESTADOS',
             'ACCEDER_REPORTES_MEJORAMIENTO',
             'CONSULTAR_REPORTES_HOSPITALIZACION',
             'CONSULTAR_REPORTES_ALTA',
             'CONSULTAR_REPORTES_DECESO',
         ]);
         $role1 = Role::create(['name' => 'VETERINARIO']);
         $role1->givePermissionTo([
            'ACCEDER_EPICRISIS',
            'VER_EPICRISIS',
            'CREAR_EPICRISIS',
            'MODIFICAR_EPICRISIS',
            'ELIMINAR_EPICRISIS',
            'ACCEDER_ESTADOS',
            'VER_ESTADOS',
            'MODIFICAR_ESTADOS',
        ]);

        $role2 = Role::create(['name' => 'RECEPCIONISTA']);
        $role2->givePermissionTo([
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
            'ACCEDER_EPICRISIS',
            'VER_EPICRISIS',
            'CREAR_EPICRISIS',
            'MODIFICAR_EPICRISIS',
            'ELIMINAR_EPICRISIS',
        ]);

    }
}
