<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('pasantias', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('idUser')->nullable();
        $table->date('fechaInicio')->nullable();
        $table->date('fechaFinal')->nullable();
        $table->time('horaIngreso')->nullable();
        $table->timestamps();

        $table->foreign('idUser')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
    });
}

public function down()
{
    Schema::dropIfExists('pasantias');
}

};
