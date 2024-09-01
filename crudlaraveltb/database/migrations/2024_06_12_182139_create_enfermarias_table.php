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
        Schema::create('enfermarias', function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->string("descricao");
            $table->dateTime("data");
            $table->string("pessoas");
            $table->string("turma");
            $table->string("status");
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
        Schema::dropIfExists('enfermarias');
    }
};
