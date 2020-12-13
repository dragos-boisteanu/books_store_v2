<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_tag', function (Blueprint $table) {
            $table->primary(['book_id', 'tag_id']);
            
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('tag_id');
            
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('book_id')->references('id')->on('books');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_tag_');
    }
}
