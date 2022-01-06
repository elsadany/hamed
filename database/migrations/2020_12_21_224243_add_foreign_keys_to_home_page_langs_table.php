<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToHomePageLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_page_langs', function (Blueprint $table) {
            $table->foreign('home_page_id', 'home_page_langs_ibfk_1')->references('id')->on('home_page')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('lang_id', 'home_page_langs_ibfk_2')->references('id')->on('languages')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_page_langs', function (Blueprint $table) {
            $table->dropForeign('home_page_langs_ibfk_1');
            $table->dropForeign('home_page_langs_ibfk_2');
        });
    }
}
