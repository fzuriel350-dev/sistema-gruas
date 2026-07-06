<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->foreignId('usuario_id')->nullable()->after('empresa_id')->constrained('users');
            $table->foreignId('aseguradora_id')->nullable()->after('usuario_id')->constrained('aseguradoras');
            $table->string('email', 100)->nullable()->after('contacto');
            $table->string('numero_poliza', 50)->nullable()->after('email');
            $table->string('tipo_cobertura_poliza', 100)->nullable()->after('numero_poliza');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropForeign(['usuario_id']);
            $table->dropForeign(['aseguradora_id']);
            $table->dropColumn(['usuario_id', 'aseguradora_id', 'email', 'numero_poliza', 'tipo_cobertura_poliza']);
            $table->dropSoftDeletes();
        });
    }
};
