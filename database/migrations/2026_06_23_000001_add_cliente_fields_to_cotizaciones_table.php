<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->string('nombre_asegurado')->nullable()->after('no_poliza');
            $table->string('telefono_asegurado', 20)->nullable()->after('nombre_asegurado');
            $table->string('no_expediente')->nullable()->after('telefono_asegurado');
            $table->integer('ano')->nullable()->after('modelo');
        });
    }

    public function down(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->dropColumn(['nombre_asegurado', 'telefono_asegurado', 'no_expediente', 'ano']);
        });
    }
};
