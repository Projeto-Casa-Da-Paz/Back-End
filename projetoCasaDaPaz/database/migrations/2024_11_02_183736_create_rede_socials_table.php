<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('rede_socials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instituicao_id')->constrained()->onDelete('cascade');
            $table->string('nome',100);
            $table->string('tipo',100);
            $table->string('url');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rede_socials');
    }
};
