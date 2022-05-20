<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTrapliprosTable extends Migration
{
    public function up()
    {
        Schema::table('traplipros', function (Blueprint $table) {
            $table->unsignedBigInteger('programaacademico_id')->nullable();
            $table->foreign('programaacademico_id', 'programaacademico_fk_6569097')->references('id')->on('programa_modulars');
            $table->unsignedBigInteger('programamodular_id')->nullable();
            $table->foreign('programamodular_id', 'programamodular_fk_6569098')->references('id')->on('programa_modulars');
            $table->unsignedBigInteger('docente_id')->nullable();
            $table->foreign('docente_id', 'docente_fk_6569125')->references('id')->on('docentes');
            $table->unsignedBigInteger('grupo_id')->nullable();
            $table->foreign('grupo_id', 'grupo_fk_6569099')->references('id')->on('grupos');
        });
    }
}
