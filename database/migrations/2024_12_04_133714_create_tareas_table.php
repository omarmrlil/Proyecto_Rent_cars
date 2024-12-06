<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id('id_tarea');
            $table->unsignedBigInteger('id_empleado');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->enum('estado', ['pendiente', 'en progreso', 'completada'])->default('pendiente');
            $table->date('fecha_limite')->nullable();
            $table->timestamps();

            $table->foreign('id_empleado')->references('id_empleado')->on('empleados')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}
