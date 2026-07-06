<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->foreignId('oficina_id')->nullable()->after('empresa_id')->constrained('oficinas');
            $table->string('puesto', 50)->nullable()->after('direccion');
            $table->decimal('sueldo_diario', 10, 2)->default(0)->after('puesto');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropForeign(['oficina_id']);
            $table->dropColumn(['oficina_id', 'puesto', 'sueldo_diario']);
            $table->dropSoftDeletes();
        });
    }
};
