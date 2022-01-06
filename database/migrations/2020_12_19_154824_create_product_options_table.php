<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_options', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('product_id')->index('product_id');
            $table->integer('option_id')->index('option_id');
            $table->integer('value_id')->nullable();
            $table->double('price', 12, 2)->nullable();
            $table->integer('stock')->nullable()->default(0);
            $table->tinyInteger('has_value')->nullable()->default(0);
            $table->string('image', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_options');
    }
}
