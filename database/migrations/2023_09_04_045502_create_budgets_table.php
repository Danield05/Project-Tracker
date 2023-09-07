<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('budgets', function (Blueprint $table) {
        $table->id(); // Campo autoincremental de ID
        $table->string('username'); // Nombre de usuario
        $table->string('month'); // Mes
        $table->string('year'); // Año
        $table->decimal('budget', 10, 2); // Presupuesto mensual, con 2 decimales
        $table->timestamps(); // Campos de fecha y hora de creación y actualización
    });
}

   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budgets');
    }
};
