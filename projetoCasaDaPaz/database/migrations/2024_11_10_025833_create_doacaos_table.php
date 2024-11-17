<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('doacoes', function (Blueprint $table) {
            $table->id();
            $table->string('banco');
            $table->string('agencia');
            $table->string('conta_corrente');
            $table->string('cnpj', 18);
            $table->string('titular');
            $table->string('chave_pix');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doacoes');
    }
};
