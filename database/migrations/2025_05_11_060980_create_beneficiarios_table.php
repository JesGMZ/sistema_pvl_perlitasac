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
        Schema::create('beneficiarios', function (Blueprint $table) {
            $table->id('idbeneficiarios'); // Primary key personalizada
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('direccion')->nullable();
            $table->string('parentesco')->nullable();
            $table->string('sexo')->nullable();
            $table->unsignedBigInteger('idcategoria'); // FK a categorias
            $table->unsignedBigInteger('idsocios'); // FK a socios
            $table->date('fechanacimiento')->nullable();
            $table->string('edad')->nullable();
            $table->string('estado')->nullable();
            $table->timestamps();

            // Claves foráneas
            $table->foreign('idcategoria')
                  ->references('idcategoria')
                  ->on('categoria')
                  ->onDelete('cascade');

            $table->foreign('idsocios')
                  ->references('idsocios')
                  ->on('socios')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beneficiarios', function (Blueprint $table) {
            // Eliminar las claves foráneas primero
            $table->dropForeign(['idcategoria']);
            $table->dropForeign(['idsocios']);
        });
        
        Schema::dropIfExists('beneficiarios');
    }
};