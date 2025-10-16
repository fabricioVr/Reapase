<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('ram', function (Blueprint $table) {
        $table->id();
        $table->string('capacidad', 20)->nullable();
        $table->string('serie', 30)->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('ram');
}

};
