<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCategoriiProduseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorii_produse', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nume');
            $table->string('slug');
            $table->string('scurta_descriere');
            $table->text('poza_principala');
            $table->text('poza_moto');
            $table->string('moto');
            $table->string('navigatie');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorii_produse');
    }
}
