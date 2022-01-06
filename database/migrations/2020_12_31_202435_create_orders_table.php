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
            $table->integer('id',true);
            $table->integer('address_id');
            $table->integer('user_id');
            $table->double('total',12,2)->default(0)->nullable();
            $table->double('discount',12,2)->default(0)->nullable();
            $table->double('price_after_discount',12,2)->default(0)->nullable();
            $table->integer('promo_id')->nullable();
            $table->integer('status_id')->default(0)->nullable();
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
}
