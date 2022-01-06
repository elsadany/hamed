<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_langs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 50);
            $table->integer('brand_id')->index('brand_id');
            $table->integer('lang_id')->index('lang_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_langs');
    }
}
