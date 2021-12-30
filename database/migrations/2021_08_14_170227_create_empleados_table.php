<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('apellido');
            $table->string('nombre');
            $table->string('nombre_medio')->nullable();
            $table->string('direccion');
            $table->foreignId('id_departamento')->constrained('departamentos');
            $table->foreignId('id_pais')->constrained('paises');
            $table->foreignId('id_provincia')->constrained('provincias');
            $table->foreignId('id_ciudad')->constrained('ciudades');
            $table->char('codigo_postal');
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_contratacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
