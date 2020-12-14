<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
           
            $table->unsignedBigInteger('payment_method_id');
            
            $table->unsignedBigInteger('shipping_method_id');

            $table->unsignedBigInteger('status_id')->nullable();

            $table->unsignedBigInteger('operator_id');

            $table->softDeletes();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->foreign('shipping_method_id')->references('id')->on('shipping_methods');
            
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->foreign('operator_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
