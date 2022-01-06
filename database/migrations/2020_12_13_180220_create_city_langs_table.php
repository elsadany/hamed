<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_langs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 150);
            $table->integer('city_id')->index('city_id');
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
        Schema::dropIfExists('city_langs');
    }
}
