<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('url_portada')->nullable()->comment('url local de la imagen de portada');
            $table->decimal('precio',10,2)->nullable()->comment('precio del curso');
            $table->integer('porcentaje_prof')->comment('porcentaje de ganancia para el profesor');
            $table->integer('profesor_id')->comment('id del profesor dueño del curso');
            $table->integer('materia_id')->comment('id de materia');
            $table->integer('usuario_id')->comment('id del usuario que registro el curso');
            $table->string('estado')->comment('ACTIVO, INACTIVO');
            $table->integer('es_eliminado')->comment('1 es eliminado, 0 no es eliminado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
