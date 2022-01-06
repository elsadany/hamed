<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('category_id')->index('category_id');
            $table->integer('brand_id')->index('brand_id');
            $table->string('image', 250);
            $table->double('price', 12, 2);
            $table->double('discount', 12, 2)->default(0)->nullable();
            $table->integer('stock')->default(0)->nullable();
            $table->double('price_after_discount', 12, 2)->default(0)->nullable();
            $table->date('discount_expire_at')->nullable();
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
        Schema::dropIfExists('products');
    }
}
