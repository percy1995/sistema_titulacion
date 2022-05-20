<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProgramaModularsTable extends Migration
{
    public function up()
    {
        Schema::table('programa_modulars', function (Blueprint $table) {
            $table->unsignedBigInteger('programaacademico_id')->nullable();
            $table->foreign('programaacademico_id', 'programaacademico_fk_6567382')->references('id')->on('programas');
        });
    }
}
