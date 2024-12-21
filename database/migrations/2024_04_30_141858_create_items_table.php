<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->string('code');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('price');
            $table->integer('price_sell');
            $table->integer('stock')->default(0);
            $table->integer('stock_alert')->default(0);
            $table->string('pcs');
            $table->string('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
