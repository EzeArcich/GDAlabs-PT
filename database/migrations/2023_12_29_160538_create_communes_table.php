<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunesTable extends Migration
{
    public function up()
    {
        Schema::create('communes', function (Blueprint $table) {
            $table->bigIncrements('id_com');
            $table->unsignedBigInteger('id_reg');
            $table->string('description', 90);
            $table->enum('status', ['A', 'I', 'trash'])->default('A');
            $table->timestamps();
            $table->index('id_reg');
            $table->foreign('id_reg')->references('id_reg')->on('regions');
        });
    }

    public function down()
    {
        Schema::dropIfExists('communes');
    }
}

