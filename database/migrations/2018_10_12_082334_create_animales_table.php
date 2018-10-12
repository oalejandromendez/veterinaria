<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_animales', function (Blueprint $table) {
            $table->increments('pk_id_animales');
            $table->string('nombre');
            $table->string('raza');
            $table->string('color');
            $table->string('sexo');
            $table->date('fecha_nacimiento');
            $table->string('seniales_particulares');
            $table->unsignedInteger('fk_id_propietario');
            $table->timestamps();
            $table->foreign('fk_id_propietario')->references('pk_id_responsables')->on('tbl_responsables')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_animales');
    }
}
