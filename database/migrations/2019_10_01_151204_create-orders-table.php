<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders',function (Blueprint $table){
                $table->bigInteger('order_id')->index();
                $table->bigInteger('item_id');
                $table->string('status');
                $table->string('shipping_street_address');
                $table->string('shipping_state');
                $table->bigInteger('shipping_zip_code');
                $table->string('driver_username');
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
