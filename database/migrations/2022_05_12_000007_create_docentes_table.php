<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentesTable extends Migration
{
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dni');
            $table->string('direccion');
            $table->string('correoinstitucional')->nullable();
            $table->string('correopersonal')->nullable();
            $table->string('celular')->nullable();
            $table->string('tipo');
            $table->integer('estado')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
