<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone');
            $table->string('country');
            $table->string('city');
            $table->unsignedInteger('zipcode');
            
            $table->unsignedInteger('price');
            $table->unsignedInteger('tax');
            $table->string('payment_method');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('ship_address_line_1')->nullable();
            $table->string('ship_address_line_2')->nullable();
            $table->string('status');
            $table->string('notes')->nullable();

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
        Schema::dropIfExists('orders');
    }
};
