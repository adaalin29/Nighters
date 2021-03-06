<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReorderingToSwiperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('swiper', function (Blueprint $table) {
            $table->integer('parent_id')->nullable();
            $table->integer('lft');
            $table->integer('rgt');
            $table->integer('depth');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('swiper', function (Blueprint $table) {
            //
        });
    }
}
