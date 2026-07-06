<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autorizaciones_cancelacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->constrained('servicios');
            $table->foreignId('usuario_solicitante_id')->constrained('users');
            $table->foreignId('usuario_resolutor_id')->nullable()->constrained('users');
            $table->text('motivo_cancelacion');
            $table->string('tipo_incidencia'); // cliente_cancela, operador_siniestro, falla_mecanica, etc.
            $table->string('estatus')->default('pendiente'); // pendiente, cancelado_por_cotizador, rechazada
            $table->dateTime('fecha_solicitud');
            $table->dateTime('fecha_resolucion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autorizaciones_cancelacion');
    }
};
