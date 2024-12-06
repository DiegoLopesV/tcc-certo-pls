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
        Schema::table('enfermarias', function (Blueprint $table) {
            // Adicionando novas colunas
            $table->text('horaInicio') -> nullable();
            $table->text('horaFinal') -> nullable();                          // Hora
            $table->string('responsavel') -> nullable();            // Responsável
            $table->integer('idade') -> nullable();                 // Idade
            $table->text('queixa') -> nullable();                   // Queixa
            $table->text('atividade_realizada') -> nullable();      // Atividade realizada
            $table->text('conduta') -> nullable();                  // Conduta
            // Removendo a coluna 'status'
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enfermarias', function (Blueprint $table) {
            // Removendo as novas colunas
            $table->dropColumn(['hora', 'responsavel', 'idade', 'queixa', 'atividade_realizada', 'conduta']);

            // Adicionando a coluna 'status' novamente
            $table->string('status');
        });
    }
};
