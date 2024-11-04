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
        Schema::table('historias', function (Blueprint $table) {
            $table->date('ano_fundacao')->nullable();
            $table->text('MVV')->nullable();
            $table->text('PMH')->nullable();
            $table->text('texto_institucional')->nullable();
            $table->string('foto_capa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historias', function (Blueprint $table) {
            $table->dropColumn('ano_fundacao');
            $table->dropColumn('MVV');
            $table->dropColumn('PMH');
            $table->dropColumn('texto_institucional');
            $table->dropColumn('foto_capa');
        });
    }
};
