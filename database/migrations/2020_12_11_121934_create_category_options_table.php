<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_options', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('category_id')->index('category_id');
            $table->tinyInteger('affect_price')->default(0);
            $table->tinyInteger('in_filter')->default(0);
            $table->integer('type');
            $table->tinyInteger('is_required')->default(0);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_options');
    }
}
