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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('instructor_prestamista');
            $table->string('nombre_aprendiz');
            $table->string('ficha_aprendiz');
            $table->string('id_aprendiz');
            $table->integer('dias_por_fuera');
            $table->text('observacion');
            $table->string('usuario_prestamista');
            $table->text('elementos_prestados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
