<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChavesTemporariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chaves_temporarias', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();  // Nome único associado à chave
            $table->string('chave');           // Chave gerada
            $table->timestamps();              // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chaves_temporarias');
    }
}
