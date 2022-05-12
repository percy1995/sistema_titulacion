<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramaModularsTable extends Migration
{
    public function up()
    {
        Schema::create('programa_modulars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombreprograma');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
