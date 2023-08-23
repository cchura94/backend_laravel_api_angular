<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string("nombres", 30);
            $table->string("apellidos", 30)->nullable();
            $table->string("ci", 15)->nullable();
            $table->string("direccion", 200)->nullable();
            $table->string("telefono", 20)->nullable();
            $table->bigInteger("user_id")->unsigned();
            // datos personales tiene una cuenta user
            // N:1
            $table->foreign("user_id")->references("id")->on("users");            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
