<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('bazars', function (Blueprint $table) {
            $table->id();
            $table->datetime('periodo_atividade');
            $table->string('localidade',255);
            $table->string('contato',100);
            $table->string('foto',100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bazars');
    }
};
