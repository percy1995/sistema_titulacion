<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToExamenSpsTable extends Migration
{
    public function up()
    {
        Schema::table('examen_sps', function (Blueprint $table) {
            $table->unsignedBigInteger('programaacademico_id')->nullable();
            $table->foreign('programaacademico_id', 'programaacademico_fk_6637535')->references('id')->on('programa_modulars');
            $table->unsignedBigInteger('programamodular_id')->nullable();
            $table->foreign('programamodular_id', 'programamodular_fk_6637536')->references('id')->on('programa_modulars');
            $table->unsignedBigInteger('docente_id')->nullable();
            $table->foreign('docente_id', 'docente_fk_6637543')->references('id')->on('docentes');
            $table->unsignedBigInteger('grupo_id')->nullable();
            $table->foreign('grupo_id', 'grupo_fk_6637544')->references('id')->on('grupos');
        });
    }
}
