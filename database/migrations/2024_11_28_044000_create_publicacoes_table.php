<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacoesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('publicacoes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titulo');
            $table->string('foto_url');
            $table->string('local')->nullable();
            $table->date('data')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('publicacoes');
    }
}
