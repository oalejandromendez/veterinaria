<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'Alejandro',
            'lastname' => 'Mendez',
            'cedula' => '1073111111',
            'age' => '20',
            'email' => 'alejo@ucundinamarca.edu.co',
            'address' => 'address',
            'phone' => '88888888',
            'password' => bcrypt('123456')
        ]);
        $user1->assignRole('ADMINISTRADOR');

    }
}
