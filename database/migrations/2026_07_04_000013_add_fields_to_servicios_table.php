<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('servicios', function (Blueprint $table) {
            $table->foreignId('oficina_id')->nullable()->after('unidad_id')->constrained('oficinas');
            $table->integer('kms_salida')->nullable()->after('fecha_fin');
            $table->integer('kms_llegada_cliente')->nullable()->after('kms_salida');
            $table->integer('kms_termino_servicio')->nullable()->after('kms_llegada_cliente');
            $table->integer('kms_regreso_base')->nullable()->after('kms_termino_servicio');
            $table->integer('kms_cobrados_reales')->nullable()->after('kms_regreso_base');
            $table->decimal('costo_final_real', 12, 2)->nullable()->after('kms_cobrados_reales');
            $table->text('observaciones')->nullable()->after('costo_final_real');
        });
    }

    public function down(): void
    {
        Schema::table('servicios', function (Blueprint $table) {
            $table->dropForeign(['oficina_id']);
            $table->dropColumn([
                'oficina_id', 'kms_salida', 'kms_llegada_cliente',
                'kms_termino_servicio', 'kms_regreso_base',
                'kms_cobrados_reales', 'costo_final_real', 'observaciones',
            ]);
        });
    }
};
