<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductOptionImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_option_images', function (Blueprint $table) {
            $table->foreign('product_id', 'product_option_images_ibfk_1')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('option_id', 'product_option_images_ibfk_2')->references('id')->on('product_options')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_option_images', function (Blueprint $table) {
            $table->dropForeign('product_option_images_ibfk_1');
            $table->dropForeign('product_option_images_ibfk_2');
        });
    }
}
