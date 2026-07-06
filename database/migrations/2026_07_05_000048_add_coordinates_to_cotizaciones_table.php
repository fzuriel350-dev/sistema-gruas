<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->decimal('origen_lat', 10, 8)->nullable()->after('origen');
            $table->decimal('origen_lng', 11, 8)->nullable()->after('origen_lat');
            $table->decimal('destino_lat', 10, 8)->nullable()->after('destino');
            $table->decimal('destino_lng', 11, 8)->nullable()->after('destino_lat');
        });
    }

    public function down(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->dropColumn(['origen_lat', 'origen_lng', 'destino_lat', 'destino_lng']);
        });
    }
};
