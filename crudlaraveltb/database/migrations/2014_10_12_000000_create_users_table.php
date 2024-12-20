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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->char('cpf', 20);// CPF tem 11 caracteres, então char é mais apropriado.
            $table->string('nome_pais', 100)->nullable();
            $table->string('telefone', 20); // Dependendo do formato, pode ser necessário mais espaço para o telefone.
            $table->string('telefone_pais', 20)->nullable();
            $table->string('email', 150);// O tamanho máximo para emails é geralmente 254 caracteres.
            $table->string('email_pais', 150)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('role');
            $table->string('password', 255); // Mantenha 255 para a senha, já que geralmente será um hash.
            $table->string('key');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
