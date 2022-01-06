<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOptionValueLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('option_value_langs', function (Blueprint $table) {
            $table->foreign('value_id', 'option_value_langs_ibfk_1')->references('id')->on('category_option_values')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('option_value_langs', function (Blueprint $table) {
            $table->dropForeign('option_value_langs_ibfk_1');
        });
    }
}
