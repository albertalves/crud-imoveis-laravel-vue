<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropriedadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propriedades', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('email_proprietario', 255);
            $table->text('rua');
            $table->string('numero', 45)->nullable();
            $table->text('complemento')->nullable();
            $table->string('bairro', 255);
            $table->string('cidade', 255);
            $table->string('estado', 100);
            $table->boolean('status')->default(0)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('propriedades');
    }
}
