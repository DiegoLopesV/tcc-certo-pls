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
        Schema::create('enfermeiros', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->string("cpf");
            $table->string("telefone");
            $table->date("data_nascimento");
            $table->string("email");
            $table->string("numeroDeContrato");
            $table->string('foto')->nullable();
            $table->string('chave')->nullable();
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
        //
    }
};
