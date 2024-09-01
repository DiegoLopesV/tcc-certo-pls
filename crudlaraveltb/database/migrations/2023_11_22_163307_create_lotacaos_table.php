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
        Schema::create('lotacaos', function (Blueprint $table) {
            $table->id();
            $table->string("nome_campus");
            $table->string("departamento");
            $table->string("area_atuacao");
            $table->bigInteger("professor_id")->unsigned();
            $table->timestamps();
        });
        
        Schema::table('lotacaos', function (Blueprint $table) {
            $table->foreign("professor_id")->references("id")->on("professors")->onDelete("cascade");
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotacaos');
        
    }
};
