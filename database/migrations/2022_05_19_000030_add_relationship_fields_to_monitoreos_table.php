<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMonitoreosTable extends Migration
{
    public function up()
    {
        Schema::table('monitoreos', function (Blueprint $table) {
            $table->unsignedBigInteger('grupo_id')->nullable();
            $table->foreign('grupo_id', 'grupo_fk_6569282')->references('id')->on('grupos');
            $table->unsignedBigInteger('docente_id')->nullable();
            $table->foreign('docente_id', 'docente_fk_6569283')->references('id')->on('docentes');
            $table->unsignedBigInteger('traplipro_id')->nullable();
            $table->foreign('traplipro_id', 'traplipro_fk_6569284')->references('id')->on('traplipros');
        });
    }
}
