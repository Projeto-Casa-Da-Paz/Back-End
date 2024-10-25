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
        Schema::create('instituicaos', function (Blueprint $table) {
            $table->id();
            $table->string('nome',100);
            $table->string('telefone',100);
            $table->string('instagram',100);
            $table->string('instagram_bazar',100);
            $table->string('fanpage',100);
            $table->string('email',100);
            $table->string('end_bazar',255);
            $table->string('end_sede',255);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instituicaos');
    }
};
