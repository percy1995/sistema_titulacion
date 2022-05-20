<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDocentesTable extends Migration
{
    public function up()
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->unsignedBigInteger('persona_id')->nullable();
            $table->foreign('persona_id', 'persona_fk_6567353')->references('id')->on('personas');
            $table->unsignedBigInteger('programa_id')->nullable();
            $table->foreign('programa_id', 'programa_fk_6567354')->references('id')->on('programas');
        });
    }
}
