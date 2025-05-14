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
        Schema::create('filiais', function (Blueprint $table) {
            $table->id();
            $table->string('filial', 30);
            $table->timestamps();
        });

        Schema::create('produto_filiais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filial_id')->constrained('filiais');
            $table->foreignId('produto_id')->constrained('produtos');
            $table->decimal('preco', 8, 2);
            $table->integer('quantidade');
            $table->timestamps();
        });

        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('preco', 'quantidade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->decimal('preco', 8, 2);
            $table->integer('quantidade');
        });

        Schema::dropIfExists('produto_filiais');
        Schema::dropIfExists('filiais');
    }
};
