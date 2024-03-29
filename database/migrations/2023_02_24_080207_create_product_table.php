<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('user');
            $table->text('product_name');
            $table->text('product_image');
            $table->text('vendor_price');
            $table->text('regular_price');
            $table->text('sale_price');
            $table->text('inventory');
            $table->text('shipping');
            $table->text('attribute');
            $table->text('category');
            $table->text('addition_info');
            $table->integer('trush_status');
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
        Schema::dropIfExists('product');
    }
}
