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
        Schema::create('registro_dividas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_membro');
            $table->integer('total-divida')->default(0);
            $table->year('ano');
            $table->timestamps();

            //foreign keys
            $table->foreign('id_membro')->references('id')->on('membros');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_dividas');
    }
};
