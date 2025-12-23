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
        Schema::create('tag_cursos', function (Blueprint $table) {
            $table->id();
            $table->integer('curso_id')->comment('id del curso');
            $table->integer('tag_id')->comment('id del tag');
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
        Schema::dropIfExists('tag_cursos');
    }
};
