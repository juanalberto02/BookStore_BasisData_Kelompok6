<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->decimal('amount', 10, 2);
            $table->text('reason');
            $table->unsignedBigInteger('store_id');
            $table->text('status');

            // Add foreign key constraint for book_id referencing the id column in the books table
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            
            $table->foreign('store_id')->references('id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returns');
    }
};
