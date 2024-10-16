<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_galeria');
            $table->string('descricao', 100);
            $table->string('nome', 100);
            $table->timestamps();

            // Define a chave estrangeira e a ação de exclusão em cascata
            $table->foreign('id_galeria')->references('id')->on('galerias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotos');
    }
};