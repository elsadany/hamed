<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBrandsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands_categories', function (Blueprint $table) {
            $table->foreign('brand_id', 'brands_categories_ibfk_1')->references('id')->on('brands')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('category_id', 'brands_categories_ibfk_2')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands_categories', function (Blueprint $table) {
            $table->dropForeign('brands_categories_ibfk_1');
            $table->dropForeign('brands_categories_ibfk_2');
        });
    }
}
