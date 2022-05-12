<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoreosTable extends Migration
{
    public function up()
    {
        Schema::create('monitoreos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fechaasesoria')->nullable();
            $table->time('horainicio')->nullable();
            $table->time('horafin')->nullable();
            $table->longText('observacion')->nullable();
            $table->integer('estado')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
