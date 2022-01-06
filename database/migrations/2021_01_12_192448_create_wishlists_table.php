<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('product_id');
            $table->biginteger('user_id')->unsigned();
            $table->timestamps();
        });
         Schema::table('wishlists', function (Blueprint $table) {
            $table->foreign('product_id', 'wishlists_ibfk_1')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
        }); 
        Schema::table('wishlists', function (Blueprint $table) {
            $table->foreign('user_id', 'wishlists_ibfk_2')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
}
