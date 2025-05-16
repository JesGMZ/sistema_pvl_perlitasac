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
        Schema::create('detallepvl', function (Blueprint $table) {
            $table->id('iddetallepvl'); // Primary key personalizada
            $table->decimal('cantidad', 10, 2)->nullable(); // Cambiado a decimal para cantidades
            $table->decimal('precio', 10, 2)->nullable(); // Cambiado a decimal para precios
            $table->unsignedBigInteger('idproductos'); // FK a productos
            $table->unsignedBigInteger('idpvl'); // FK a pvls
            
            $table->timestamps();

            // Claves foráneas
            $table->foreign('idproductos')
                  ->references('idproductos')
                  ->on('productos')
                  ->onDelete('cascade');

            $table->foreign('idpvl')
                  ->references('idpvl')
                  ->on('pvl')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detallepvl', function (Blueprint $table) {
            // Eliminar las claves foráneas primero
            $table->dropForeign(['idproductos']);
            $table->dropForeign(['idpvl']);
        });
        
        Schema::dropIfExists('detallepvl');
    }
};