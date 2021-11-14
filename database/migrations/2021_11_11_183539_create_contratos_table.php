<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('propriedade_id')->constrained('propriedades');
            $table->string('tipo_pessoa', 45);
            $table->string('documento', 45);
            $table->string('email_contratante', 255);
            $table->string('nome_completo_contratante', 150);
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
        Schema::dropIfExists('contratos');
    }
}
