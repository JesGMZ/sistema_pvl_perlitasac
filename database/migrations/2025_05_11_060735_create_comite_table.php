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
        Schema::create('comite', function (Blueprint $table) {
            $table->id('idcomite'); // Primary key personalizada
            $table->string('codigo')->nullable();
            $table->string('nombre')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('estado')->nullable();
            $table->string('coordinadora')->nullable();
            $table->unsignedBigInteger('idmunicipalidad'); // FK a municipalidad
            
            $table->timestamps();

            // Clave foránea
            $table->foreign('idmunicipalidad')
                  ->references('idmunicipalidad')
                  ->on('municipalidad')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comite', function (Blueprint $table) {
            // Eliminar la clave foránea primero
            $table->dropForeign(['idmunicipalidad']);
        });
        
        Schema::dropIfExists('comite');
    }
};