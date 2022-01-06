<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_langs', function (Blueprint $table) {
            $table->foreign('lang_id', 'product_langs_ibfk_1')->references('id')->on('languages')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('product_id', 'product_langs_ibfk_2')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_langs', function (Blueprint $table) {
            $table->dropForeign('product_langs_ibfk_1');
            $table->dropForeign('product_langs_ibfk_2');
        });
    }
}
