<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdreseLivrareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adrese_livrare', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('uid');
            $table->string('nume');
            $table->string('telefon');
            $table->string('adresa');
            $table->string('oras');
            $table->string('judet');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adrese_livrare');
    }
}
