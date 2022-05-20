<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->integer('estado')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
