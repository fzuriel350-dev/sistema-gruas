<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cargas_diesel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->foreignId('unidad_id')->constrained('unidades');
            $table->foreignId('operador_id')->constrained('operadores');
            $table->decimal('litros', 8, 2);
            $table->decimal('costo_litro', 6, 2);
            $table->decimal('importe_total', 10, 2);
            $table->integer('km_actual');
            $table->dateTime('fecha_carga');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cargas_diesel');
    }
};
