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

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('herramienta_id')->nullable();
            $table->foreign('herramienta_id')
                ->references('id')
                ->on('herramientas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('mat_consumible_id')->nullable();
            $table->foreign('mat_consumible_id')
                ->references('id')
                ->on('mat_consumibles')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
