<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create(
            'campanhas',
            function (Blueprint $table) {
                $table->id();
                $table->string('nome_campanha',100);
                $table->date('data_inicio');
                $table->date('data_final');
                $table->text('detalhes');
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('campanhas');
    }
};
