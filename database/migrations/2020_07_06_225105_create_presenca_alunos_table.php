<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresencaAlunosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('presenca_alunos', function (Blueprint $table) {
            $table->id();
            $table->integer('aluno_id');
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->integer('plano_id');
            $table->foreign('plano_id')->references('id')->on('planos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('presenca_alunos');
    }
}
