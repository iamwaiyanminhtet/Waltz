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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->integer('price');
            $table->longText('description');
            $table->string('image');
            $table->string('availability')->default('inStock');
            $table->integer('view_count')->default(0);
            $table->integer('featured')->default(0); // 0 false | 1 true
            $table->integer('year')->nullable();
            $table->string('sorting_word')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
