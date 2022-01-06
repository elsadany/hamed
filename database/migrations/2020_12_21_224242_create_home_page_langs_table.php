<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePageLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_langs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 50);
            $table->integer('lang_id')->index('lang_id');
            $table->integer('home_page_id')->index('home_section_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_page_langs');
    }
}
