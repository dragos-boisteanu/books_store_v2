<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->string('name');
            $table->string('first_name');
            $table->string('phone_number');

            $table->unsignedBigInteger('county_id');
            $table->unsignedBigInteger('city_id');

            $table->string('address')->nullable(); 
            $table->string('postal_code')->nullable();
            
            // $table->string('company_name')->nullable();
            // $table->string('trade_register_number')->nullable();
            // $table->string('bank')->nullable();
            // $table->string('iban')->nullable();
            // $table->string('fiscal_code')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('county_id')->references('id')->on('counties');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
