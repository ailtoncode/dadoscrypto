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
        Schema::create('broker_symbols', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_broker');
            $table->foreign('id_broker')->references('id')->on('brokers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_currency_symbols');
            $table->foreign('id_currency_symbols')->references('id')->on('currency_symbols')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('broker_symbols');
    }
};
