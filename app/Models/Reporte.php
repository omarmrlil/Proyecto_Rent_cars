<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportesTable extends Migration
{
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id('id_reporte');
            $table->string('tipo_reporte');
            $table->enum('estado_reporte', ['pendiente', 'generado'])->default('pendiente');
            $table->timestamp('fecha_generacion')->nullable();
            $table->string('ruta_archivo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reportes');
    }
}
