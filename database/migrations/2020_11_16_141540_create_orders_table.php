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
            
            $table->unsignedBigInteger('invoice_address_id');
            $table->unsignedBigInteger('shipping_address_id');
            
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('status_id');
            
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('invoice_address_id')->references('id')->on('order_addresses');
            $table->foreign('shipping_address_id')->references('id')->on('order_addresses');
            
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->foreign('status_id')->references('id')->on('statuses');
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
