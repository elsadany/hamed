<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('order_id')->nullable();
            $table->integer('product_id');
            $table->integer('number');
            $table->integer('value_id')->nullable();
            $table->string('value')->nullable();
            $table->double('price',12,2)->default(0)->nullable();
            $table->double('total',12,2)->default(0)->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
