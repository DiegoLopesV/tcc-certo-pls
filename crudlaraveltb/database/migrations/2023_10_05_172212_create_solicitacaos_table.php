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
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->string("texto");
            $table->dateTime("data");
            $table->string("status");
            $table->bigInteger("user_id")->unsigned();
            $table->timestamps();
        });
        
            Schema::table("solicitacoes",
                function (Blueprint $table) {
                $table->foreign("user_id")
                    ->references("id")
                    ->on("users")
                    ->onDelete("cascade");
            });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitacoes');
    }
};
