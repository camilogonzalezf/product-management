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
        Schema::create('order__details', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->decimal('price_total',10,2);
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order__details');
    }
};
