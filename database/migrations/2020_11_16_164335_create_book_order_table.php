<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_order', function (Blueprint $table) {
            $table->primary(['order_id', 'book_id']);

            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('order_id');
            
            $table->integer('quantity')->default(1);
            $table->integer('price')->default(1);
            
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('book_id')->references('id')->on('books');

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_book');
    }
}
