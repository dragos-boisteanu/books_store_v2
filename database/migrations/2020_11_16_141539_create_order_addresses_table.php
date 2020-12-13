<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('first_name');
            $table->string('phone_number');

            $table->string('country');
            $table->string('city');

            $table->string('address')->nullable(); 
            $table->string('postal_code')->nullable();
            
            // $table->string('company_name')->nullable();
            // $table->string('trade_register_number')->nullable();
            // $table->string('bank')->nullable();
            // $table->string('iban')->nullable();
            // $table->string('fiscal_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_addresses');
    }
}
