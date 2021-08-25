<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecenziiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recenzii', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nume');
            $table->string('email');
            $table->string('oras');
            $table->string('mesaj');
            $table->integer('rating');
            $table->string('status');
            $table->text('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recenzii');
    }
}
