<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForignKeyToProductOptionLangs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_option_langs', function (Blueprint $table) {
            $table->foreign('product_option_id', 'product_option_id_ibfk_1')->references('id')->on('product_options')->onUpdate('CASCADE')->onDelete('CASCADE');
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
            //
        });
    }
}
