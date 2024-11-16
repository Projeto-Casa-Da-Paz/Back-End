<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriasTable extends Migration
{
    public function up()
    {
        Schema::create('historias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100);
            $table->date('ano_fundacao')->nullable();
            $table->text('MVV')->nullable();
            $table->text('PMH')->nullable();
            $table->text('texto_institucional')->nullable();
            $table->string('foto_capa')->nullable(); // Armazena o caminho da imagem
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('historias');
    }
}
