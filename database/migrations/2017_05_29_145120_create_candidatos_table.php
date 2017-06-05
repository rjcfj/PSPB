<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
           $table->increments('id');
		       $table->string('nome');
           $table->string('email');
           $table->string('cpf', 14);
           $table->string('telefone', 18);
           $table->string('tecnica');
           $table->string('sociais');
           $table->string('experiencia');
           $table->string('arquivo')->nullable();;
           $table->boolean('confirmacao')->default(0);
           $table->string('cod_confirmacao')->nullable();
           $table->integer('job_id')->unsigned();
           $table->foreign('job_id')
           ->references('id')
           ->on('jobs')
           ->onDelete('cascade');
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
        Schema::dropIfExists('candidatos');
    }
}
