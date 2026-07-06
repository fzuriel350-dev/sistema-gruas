<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bitacora_tiempos_servicio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->constrained('servicios');
            $table->dateTime('hora_asignado')->nullable();
            $table->dateTime('hora_inicio_servicio')->nullable();
            $table->dateTime('hora_en_sitio_origen')->nullable();
            $table->dateTime('hora_salida_destino')->nullable();
            $table->dateTime('hora_en_destino')->nullable();
            $table->dateTime('hora_finalizado')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bitacora_tiempos_servicio');
    }
};
