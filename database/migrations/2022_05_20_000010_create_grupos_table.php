<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->nullable();
            $table->string('dia')->nullable();
            $table->time('horainicio')->nullable();
            $table->time('horafin')->nullable();
            $table->string('tipo');
            $table->string('aula');
            $table->string('tiposustentacion')->nullable();
            $table->integer('estado')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
