<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('unidades', function (Blueprint $table) {
            $table->foreignId('oficina_id')->nullable()->after('empresa_id')->constrained('oficinas');
            $table->string('modelo', 45)->nullable()->after('tipo');
            $table->string('numero_economico', 50)->nullable()->after('placas');
            $table->string('estado_emplacado', 50)->nullable()->after('numero_serie');
            $table->boolean('activo')->default(true)->after('seguro_vencimiento');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('unidades', function (Blueprint $table) {
            $table->dropForeign(['oficina_id']);
            $table->dropColumn(['oficina_id', 'modelo', 'numero_economico', 'estado_emplacado', 'activo']);
            $table->dropSoftDeletes();
        });
    }
};
