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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('book_name');
            $table->string('book_description');
            $table->integer('book_stock_A');
            $table->integer('book_stock_B');
            $table->integer('book_price');
            $table->unsignedBigInteger('store_id');
        });

        Schema::table('books', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::table('books', function (Blueprint $table) {
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
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
