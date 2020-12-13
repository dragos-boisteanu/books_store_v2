<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->string('isbn')->unique();
            $table->string('pages');

            $table->text('description')->nullable();

            $table->decimal('price', 6, 2);
            $table->decimal('discount', 4, 2)->default(0);

            $table->date('published_at');

            $table->unsignedBigInteger('publisher_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('cover_id');
            $table->unsignedBigInteger('language_id');
      
          
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');

            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('publisher_id')->references('id')->on('publishers');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('cover_id')->references('id')->on('covers');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
