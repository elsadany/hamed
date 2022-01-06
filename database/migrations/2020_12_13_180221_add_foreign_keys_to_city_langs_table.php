<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCityLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('city_langs', function (Blueprint $table) {
            $table->foreign('city_id', 'city_langs_ibfk_1')->references('id')->on('cities')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('lang_id', 'city_langs_ibfk_2')->references('id')->on('languages')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('city_langs', function (Blueprint $table) {
            $table->dropForeign('city_langs_ibfk_1');
            $table->dropForeign('city_langs_ibfk_2');
        });
    }
}
