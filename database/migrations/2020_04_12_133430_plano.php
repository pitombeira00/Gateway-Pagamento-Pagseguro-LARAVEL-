<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Plano extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plano', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('periodo',1);
            $table->double('valor');
            $table->string('apagado',1);
            $table->string('code_retorno')->nullable();
            $table->string('data_retorno')->nullable();
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
        Schema::dropIfExists('plano');
    }
}
