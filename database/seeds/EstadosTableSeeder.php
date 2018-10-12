<?php

use Illuminate\Database\Seeder;
use App\Estado;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::insert([
            ['estado' => 'EN CONSULTA'],
            ['estado' => 'HOSPITALIZACION'],
            ['estado' => 'DE ALTA'],
            ['estado' => 'DECESO']
        ]);
    }
}
