<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('id_order');
            $table->integer('id_user');
            $table->string('user_name');
            $table->string('phone');
            $table->string('email');
            $table->text('delivery_address');
            $table->float('total');
            $table->string('status');
            $table->string('payment_method');
            $table->string('delivery_method');
            $table->string('platform');
            $table->text('billing_address');
            $table->float('delivery_price');
            $table->string('awb_fancourier');
            $table->text('invoice_fancourier');
            $table->text('invoice');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
