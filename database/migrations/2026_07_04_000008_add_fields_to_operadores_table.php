<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('operadores', function (Blueprint $table) {
            $table->date('licencia_vencimiento_federal')->nullable()->after('licencia_año_vencimiento');
            $table->integer('puntos_acumulados')->default(0)->after('disponible');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('operadores', function (Blueprint $table) {
            $table->dropColumn(['licencia_vencimiento_federal', 'puntos_acumulados']);
            $table->dropSoftDeletes();
        });
    }
};
