<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToGruposTable extends Migration
{
    public function up()
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->unsignedBigInteger('periodo_id')->nullable();
            $table->foreign('periodo_id', 'periodo_fk_6569073')->references('id')->on('periodos');
            $table->unsignedBigInteger('docente_id')->nullable();
            $table->foreign('docente_id', 'docente_fk_6569074')->references('id')->on('docentes');
            $table->unsignedBigInteger('programaestudio_id')->nullable();
            $table->foreign('programaestudio_id', 'programaestudio_fk_6569075')->references('id')->on('programas');
        });
    }
}
