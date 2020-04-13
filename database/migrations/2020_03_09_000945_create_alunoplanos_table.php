<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunoplanosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunoplanos', function (Blueprint $table) {
            $table->id();
            $table->integer('aluno_id');
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->integer('plano_id');
            $table->foreign('plano_id')->references('id')->on('planos');
            $table->integer('dias_restantes');
            $table->timestamp('ultima_visita')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
