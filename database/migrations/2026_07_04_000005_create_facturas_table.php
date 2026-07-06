<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('servicio_id')->constrained('servicios');
            $table->string('uuid_fiscal', 100)->nullable();
            $table->string('folio_factura', 50);
            $table->decimal('subtotal', 12, 2);
            $table->decimal('iva', 10, 2);
            $table->decimal('total', 12, 2);
            $table->string('xml_url', 255)->nullable();
            $table->string('pdf_url', 255)->nullable();
            $table->string('estatus')->default('vigente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
