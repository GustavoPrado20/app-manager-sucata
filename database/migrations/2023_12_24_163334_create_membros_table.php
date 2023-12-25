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
        Schema::create('membros', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('ocupação');
            $table->unsignedBigInteger('id_time')->nullable();
            $table->integer('gols')->nullable();
            $table->integer('faltas')->nullable();
            $table->date('data-entrada-time');
            $table->boolean('status');
            $table->timestamps();

            //foreign key
            $table->foreign('id_time')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membros');
    }
};