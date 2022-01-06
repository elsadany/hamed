<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->integer('id',true);
            $table->string('session_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('number')->default(1)->nullable();
            $table->integer('product_id');
            $table->integer('value_id')->nullable();
            $table->timestamps();
        });
         Schema::table('cart', function (Blueprint $table) {
            $table->foreign('product_id', 'cart_ibfk_1')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
