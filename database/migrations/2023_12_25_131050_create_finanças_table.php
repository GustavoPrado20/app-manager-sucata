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
        Schema::create('finanças', function (Blueprint $table) {
            $table->id();
            $table->decimal('saldo-liquido-total')->default(0);
            $table->integer('saldo-bruto-ganho')->default(0);
            $table->decimal('dispesas')->default(0);
            $table->year('ano');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finanças');
    }
};
