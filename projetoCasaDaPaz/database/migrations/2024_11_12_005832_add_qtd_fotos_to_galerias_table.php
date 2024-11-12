<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('galerias', function (Blueprint $table) {
            $table->integer('qtd_fotos')->after('local')->default(0);
        });
    }

    public function down()
    {
        Schema::table('galerias', function (Blueprint $table) {
            $table->dropColumn('qtd_fotos');
        });
    }
};
