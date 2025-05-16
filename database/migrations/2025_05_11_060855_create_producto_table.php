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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('idproductos'); // Primary key personalizada
            
            // Campos del modelo
            $table->string('descripcion')->nullable();
            $table->string('unidadmedida')->nullable();
            $table->string('marca')->nullable();
            $table->string('origen')->nullable();
            $table->date('fecha')->nullable();
            $table->decimal('cantidad', 10, 2)->nullable(); // Mejor tipo para cantidades
            $table->date('fechavencimiento')->nullable();
            
            $table->timestamps(); // Campos de control de fecha creación/actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
