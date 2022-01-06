<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCategoryOptionLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_option_langs', function (Blueprint $table) {
            $table->foreign('option_id', 'category_option_langs_ibfk_1')->references('id')->on('category_options')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_option_langs', function (Blueprint $table) {
            $table->dropForeign('category_option_langs_ibfk_1');
        });
    }
}
