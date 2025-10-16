<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 30)->nullable();
            $table->string('cpu', 50)->nullable();
            $table->string('disco', 50)->nullable();
            $table->string('estado', 30)->nullable();

            $table->unsignedBigInteger('idMarca')->nullable();
            $table->string('modelo', 50)->nullable();
            $table->unsignedBigInteger('idRAM')->nullable();
            $table->unsignedBigInteger('idUser')->nullable();

            $table->string('monitor', 50)->nullable();
            $table->string('teclado', 50)->nullable();
            $table->string('mouse', 50)->nullable();
            $table->string('otros', 100)->nullable();

            $table->timestamps();

            $table->foreign('idMarca')->references('id')->on('marcas')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('idRAM')->references('id')->on('ram')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('idUser')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipos');
    }
};
