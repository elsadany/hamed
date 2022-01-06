<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_options', function (Blueprint $table) {
            $table->foreign('option_id', 'product_options_ibfk_1')->references('id')->on('category_options')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('product_id', 'product_options_ibfk_2')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_options', function (Blueprint $table) {
            $table->dropForeign('product_options_ibfk_1');
            $table->dropForeign('product_options_ibfk_2');
        });
    }
}
