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
        Schema::create('socios', function (Blueprint $table) {
            $table->id('idsocios'); // Primary key personalizada
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('dni', 8)->nullable(); // DNI peruano de 8 dígitos
            $table->string('direccion')->nullable();
            $table->string('sexo', 20)->nullable(); // M/F u otro
            $table->date('fechanacimiento')->nullable();
            $table->integer('edad')->nullable();
            $table->timestamps(); // Campos de auditoría
            
            // Índices para mejor performance
            $table->index('dni');
            $table->index(['nombres', 'apellidos']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socios');
    }
};