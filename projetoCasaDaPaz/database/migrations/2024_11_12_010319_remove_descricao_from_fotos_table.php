<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('fotos', function (Blueprint $table) {
            $table->dropColumn('descricao'); // Remove a coluna descricao
        });
    }

    public function down()
    {
        Schema::table('fotos', function (Blueprint $table) {
            $table->text('descricao')->nullable(); // Recria a coluna descricao, caso a migration seja revertida
        });
    }
};
