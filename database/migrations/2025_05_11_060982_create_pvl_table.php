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
        Schema::create('pvl', function (Blueprint $table) {
            $table->id('idpvl'); // Primary key personalizada
            $table->date('fecha')->nullable();
            $table->unsignedBigInteger('idbeneficiarios'); // FK a beneficiarios
            $table->unsignedBigInteger('idcomite'); // FK a comite
            $table->string('estado')->nullable()->default('Vigente');
            $table->string('mes', 20)->nullable();
            $table->timestamps();

            // Claves foráneas
            $table->foreign('idbeneficiarios')
                  ->references('idbeneficiarios')
                  ->on('beneficiarios')
                  ->onDelete('restrict');

            $table->foreign('idcomite')
                  ->references('idcomite')
                  ->on('comite')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pvl', function (Blueprint $table) {
            // Eliminar las claves foráneas primero
            $table->dropForeign(['idbeneficiarios']);
            $table->dropForeign(['idcomite']);
        });
        
        Schema::dropIfExists('pvl');
    }
};