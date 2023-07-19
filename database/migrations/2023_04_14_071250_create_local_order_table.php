<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user_register');
            $table->text('name');
            $table->text('email');
            $table->text('contact');
            $table->text('address');
            $table->text('postcode');
            $table->text('country');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('product');
            $table->text('Payment_type');
            $table->text('attribute')->nullable();
            $table->text('total_price');
            $table->text('qty');
            $table->text('addition_information');
            $table->text('confirm_status');
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
        Schema::dropIfExists('local_order');
    }
}
