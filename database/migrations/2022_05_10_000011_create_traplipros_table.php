<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrapliprosTable extends Migration
{
    public function up()
    {
        Schema::create('traplipros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('titulo')->nullable();
            $table->string('nota')->nullable();
            $table->string('c_1')->nullable();
            $table->string('c_2')->nullable();
            $table->string('c_3')->nullable();
            $table->string('c_4')->nullable();
            $table->string('ob_1')->nullable();
            $table->string('ob_2')->nullable();
            $table->string('ob_3')->nullable();
            $table->string('ob_4')->nullable();
            $table->longText('presupuesto')->nullable();
            $table->longText('conclusiones')->nullable();
            $table->string('estado')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
