<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadosEpicrisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_estados_epicrisis', function (Blueprint $table) {
            $table->increments('pk_id_estados_epicrisis');
            $table->date('fecha');
            $table->unsignedInteger('fk_id_epicrisis');
            $table->unsignedInteger('fk_id_estado');
            $table->timestamps();

            $table->foreign('fk_id_epicrisis')->references('pk_id_epicrisis')->on('tbl_epicrisis')->onDelete('cascade');
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
        Schema::dropIfExists('estados_epicrisis');
    }
}
