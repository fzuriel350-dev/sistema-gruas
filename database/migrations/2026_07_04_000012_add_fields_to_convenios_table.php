<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('convenios', function (Blueprint $table) {
            $table->boolean('cubre_casetas_peaje')->default(false)->after('km_incluidos');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('convenios', function (Blueprint $table) {
            $table->dropColumn('cubre_casetas_peaje');
            $table->dropSoftDeletes();
        });
    }
};
