<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_products', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('tag_id');
            $table->integer('product_id');
            $table->timestamps();
        });
         Schema::table('tags_products', function (Blueprint $table) {
            $table->foreign('product_id', 'tags_products_ibfk_1')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
        }); 
        Schema::table('tags_products', function (Blueprint $table) {
            $table->foreign('tag_id', 'tags_products_ibfk_2')->references('id')->on('general_tags')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags_products');
    }
}
