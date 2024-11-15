<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->string('id_diretorio')->nullable();
        });
    }


    public function down(): void
    {
        Schema::table('documentos', function (Blueprint $table) {

            $table->dropColumn('id_diretorio');
        });
    }
};
