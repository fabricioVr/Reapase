<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('docentes', function (Blueprint $table) {
        $table->id();
        $table->string('carrera', 50)->nullable();
        $table->unsignedBigInteger('idUser')->nullable();
        $table->timestamps();

        $table->foreign('idUser')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
    });
}

public function down()
{
    Schema::dropIfExists('docentes');
}
};
