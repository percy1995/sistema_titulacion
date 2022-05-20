<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajoPracticosTable extends Migration
{
    public function up()
    {
        Schema::create('trabajo_practicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('titulo')->nullable();
            $table->date('fecha');
            $table->string('horainicio')->nullable();
            $table->string('horafin')->nullable();
            $table->string('nota')->nullable();
            $table->longText('conclusiones')->nullable();
            $table->string('estado')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
