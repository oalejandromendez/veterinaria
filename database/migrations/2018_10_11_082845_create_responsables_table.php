<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_responsables', function (Blueprint $table) {
            $table->increments('pk_id_responsables');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('telefono');
            $table->string('ocupacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_responsables');
    }
}
