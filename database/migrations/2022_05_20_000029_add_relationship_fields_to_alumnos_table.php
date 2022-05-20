<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAlumnosTable extends Migration
{
    public function up()
    {
        Schema::table('alumnos', function (Blueprint $table) {
            $table->unsignedBigInteger('traplipro_id')->nullable();
            $table->foreign('traplipro_id', 'traplipro_fk_6569191')->references('id')->on('traplipros');
        });
    }
}
