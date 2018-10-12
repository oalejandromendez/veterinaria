<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpicrisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_epicrisis', function (Blueprint $table) {
            $table->increments('pk_id_epicrisis');
            $table->date('fecha_de_admision');
            $table->unsignedInteger('fk_id_medico_veterinario');
            $table->unsignedInteger('fk_id_animal');
            $table->unsignedInteger('fk_id_responsable');
            $table->string('motivo_consulta');
            $table->string('vacunas');
            $table->string('alergias');
            $table->string('enfermedades_anteriores');
            $table->string('cirugias');
            $table->double('pulso');
            $table->double('temperatura');
            $table->double('peso');
            $table->string('examenes_clinicos');
            $table->string('diagnostico');
            $table->unsignedInteger('fk_id_estado');
            $table->timestamps();

            $table->foreign('fk_id_medico_veterinario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('fk_id_animal')->references('pk_id_animales')->on('tbl_animales')->onDelete('cascade');
            $table->foreign('fk_id_responsable')->references('pk_id_responsables')->on('tbl_responsables')->onDelete('cascade');
            $table->foreign('fk_id_estado')->references('pk_id_estado')->on('tbl_estado')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_epicrisis');
    }
}
