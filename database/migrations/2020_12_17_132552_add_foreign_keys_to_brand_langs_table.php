<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBrandLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brand_langs', function (Blueprint $table) {
            $table->foreign('brand_id', 'brand_langs_ibfk_1')->references('id')->on('brands')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('lang_id', 'brand_langs_ibfk_2')->references('id')->on('languages')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brand_langs', function (Blueprint $table) {
            $table->dropForeign('brand_langs_ibfk_1');
            $table->dropForeign('brand_langs_ibfk_2');
        });
    }
}
