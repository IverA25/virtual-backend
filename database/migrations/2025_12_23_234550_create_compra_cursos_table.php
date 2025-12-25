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
        Schema::create('compra_cursos', function (Blueprint $table) {
            $table->id();
            $table->integer('curso_id')->comment('id del curso');
            $table->integer('user_id')->comment('id del usuario que hace la compra');
            $table->decimal('monto', 10, 2)->comment('monto pagado por el curso');
            $table->integer('porcentaje_prof')->comment('porcentaje que se asigna al profesor');
            $table->decimal('monto_prof', 10, 2)->comment('monto asignado para el profesor');
            $table->timestamp('fecha_compra')->comment('fecha de compra');
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
        Schema::dropIfExists('compra_cursos');
    }
};
