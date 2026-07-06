<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cotizaciones_new', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->foreignId('cliente_id')->nullable()->constrained('clientes');
            $table->foreignId('aseguradora_id')->constrained('aseguradoras');
            $table->foreignId('tipo_servicio_id')->constrained('tipos_servicio');
            $table->string('folio', 50)->unique();
            $table->text('origen_direccion');
            $table->text('destino_direccion');
            $table->decimal('origen_lat', 10, 8)->nullable();
            $table->decimal('origen_lng', 11, 8)->nullable();
            $table->decimal('destino_lat', 10, 8)->nullable();
            $table->decimal('destino_lng', 11, 8)->nullable();
            $table->decimal('distancia_km', 10, 2);
            $table->integer('tiempo_estimado_minutos')->nullable();
            $table->decimal('costo_banderazo', 10, 2);
            $table->decimal('costo_km', 10, 2);
            $table->decimal('km_excedente', 10, 2)->default(0);
            $table->boolean('incluye_peajes')->default(false);
            $table->decimal('costo_aprox_casetas', 10, 2)->default(0);
            $table->decimal('costo_total', 12, 2);
            $table->foreignId('convenio_aplicado_id')->nullable()->constrained('convenios');
            $table->foreignId('usuario_creador_id')->constrained('users');
            $table->string('estatus')->default('pendiente');
            $table->timestamps();
        });

        $columns = [
            'id', 'empresa_id', 'cliente_id', 'aseguradora_id', 'tipo_servicio_id',
            'folio', 'origen_lat', 'origen_lng', 'destino_lat', 'destino_lng',
            'distancia_km', 'costo_banderazo', 'costo_km', 'km_excedente',
            'costo_total', 'created_at', 'updated_at',
        ];
        $selects = [];
        $inserts = [];
        foreach ($columns as $col) {
            $selects[] = $col;
            $inserts[] = $col;
        }
        $selects[] = 'origen AS origen_direccion';
        $selects[] = 'destino AS destino_direccion';
        $selects[] = 'tiempo_estimado AS tiempo_estimado_minutos';
        $selects[] = 'con_peaje AS incluye_peajes';
        $selects[] = 'costo_casetas AS costo_aprox_casetas';
        $selects[] = 'convenio_id AS convenio_aplicado_id';
        $selects[] = 'created_by AS usuario_creador_id';
        $selects[] = 'estatus';

        $cols = implode(', ', $columns);
        $select = implode(', ', $selects);

        DB::statement("INSERT INTO cotizaciones_new ({$cols}, origen_direccion, destino_direccion, tiempo_estimado_minutos, incluye_peajes, costo_aprox_casetas, convenio_aplicado_id, usuario_creador_id, estatus) SELECT {$select} FROM cotizaciones");

        Schema::disableForeignKeyConstraints();
        Schema::drop('cotizaciones');
        Schema::rename('cotizaciones_new', 'cotizaciones');
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');

        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('aseguradora_id')->constrained('aseguradoras');
            $table->foreignId('tipo_servicio_id')->constrained('tipos_servicio');
            $table->string('folio', 50)->unique();
            $table->text('origen');
            $table->text('destino');
            $table->decimal('distancia_km', 10, 2);
            $table->integer('tiempo_estimado');
            $table->string('tipo_ruta');
            $table->decimal('costo_banderazo', 10, 2);
            $table->decimal('costo_km', 10, 2);
            $table->decimal('km_excedente', 10, 2)->default(0);
            $table->decimal('costo_total', 12, 2);
            $table->string('no_poliza')->nullable();
            $table->string('marca');
            $table->string('modelo');
            $table->string('color')->nullable();
            $table->string('placas');
            $table->boolean('con_peaje')->default(false);
            $table->integer('num_casetas')->default(0);
            $table->decimal('costo_casetas', 10, 2)->default(0);
            $table->decimal('costo_kilometraje', 10, 2)->default(0);
            $table->decimal('extras', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('iva', 10, 2)->default(0);
            $table->string('cobertura')->default('sin_cobertura');
            $table->foreignId('convenio_id')->nullable()->constrained('convenios');
            $table->decimal('descuento_porcentaje', 5, 2)->default(0);
            $table->decimal('descuento_monto', 10, 2)->default(0);
            $table->text('notas')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->string('estatus')->default('pendiente');
            $table->timestamps();
        });
    }
};
