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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->string("cpf");
            $table->string("nome_pais");
            $table->string("telefone");
            $table->string("telefone_pais");
            $table->string("email");
            $table->string("email_pais");
            $table->string("curso");
            $table->string("turma");
            $table->string("ano_atual");
            $table->boolean("status_reprovacao");
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
        Schema::dropIfExists('alunos');
    }
};
