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
        Schema::create('sneakers', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('colorway');
            $table->decimal('estimatedMarketValue', 10, 2);
            $table->string('gender');
            $table->json('image');
            $table->json('links');
            $table->string('name');
            $table->date('release_date');
            $table->year('release_year');
            $table->decimal('retail_price', 10, 2);
            $table->string('silhouette');
            $table->string('sku')->unique();
            $table->text('story')->nullable();
            $table->string('uid')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sneakers');
    }
};