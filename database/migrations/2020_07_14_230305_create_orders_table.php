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
            $table->uuid('id');
            $table->bigIncrements('ref');
            $table->uuid('user_id');
            $table->uuid('admin_id')->nullable();//the one that approved this order

            $table->dateTime('order_date');
            $table->enum('status',['PROCESSING','CANCELED','APPROVED'])->default('PROCESSING');
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
