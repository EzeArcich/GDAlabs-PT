<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->string('dni')->comment('Documento de Identidad');
            $table->unsignedBigInteger('id_reg');
            $table->unsignedBigInteger('id_com');
            $table->string('email')->unique()->comment('Correo Electrónico');
            $table->string('name')->comment('Nombre');
            $table->string('last_name')->comment('Apellido');
            $table->string('address')->nullable()->comment('Dirección');
            $table->timestamp('date_reg')->nullable()->comment('Fecha y hora del registro');
            $table->enum('status', ['A', 'I', 'trash'])->default('A')->comment('Estado del registro: A - Activo, I - Desactivado, trash - Registro eliminado');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary(['dni', 'id_reg', 'id_com']);
            $table->index(['id_com', 'id_reg']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
