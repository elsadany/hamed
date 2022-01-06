<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveValueFromCategoryOptionValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_option_values', function (Blueprint $table) {
            $table->dropColumn('value');
            $table->dropColumn('lang_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_option_values', function (Blueprint $table) {
            //
        });
    }
}
