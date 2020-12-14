<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_order', function (Blueprint $table) {
            $table->primary(['order_id', 'address_id']);

            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('invoice_id');

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('address_id')->references('id')->on('addresses');   
            $table->foreign('invoice_id')->references('id')->on('addresses');          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
