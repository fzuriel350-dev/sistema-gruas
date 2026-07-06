<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oficinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->string('nombre', 100);
            $table->text('direccion')->nullable();
            $table->string('ciudad', 60)->nullable();
            $table->string('estado', 45)->nullable();
            $table->string('telefono', 25)->nullable();
            $table->string('encargado', 150)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oficinas');
    }
};
