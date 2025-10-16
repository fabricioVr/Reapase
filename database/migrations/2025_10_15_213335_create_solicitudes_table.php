<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('solicitudes', function (Blueprint $table) {
        $table->id('idSolicitud');
        $table->string('estado', 20)->nullable();
        $table->date('fecha')->nullable();
        $table->unsignedBigInteger('idUsuario')->nullable();
        $table->unsignedBigInteger('idEquipo')->nullable();
        $table->text('problema')->nullable();
        $table->timestamps();

        $table->foreign('idUsuario')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
        $table->foreign('idEquipo')->references('id')->on('equipos')->onUpdate('cascade')->onDelete('set null');
    });
}
public function down()
{
    Schema::dropIfExists('solicitudes');
}

};
