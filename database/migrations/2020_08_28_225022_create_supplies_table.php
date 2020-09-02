<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('product_id');
            $table->uuid('history_id')->nullable();

            $table->bigIncrements('ref');
            $table->integer('quantity');
            $table->dateTime('supply_date');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->decimal('admission_price',7,2);

            $table->enum('status',['WAITING','IN PROGRESS','CANCELED','COMPLETED'])->default('WAITING');
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
        Schema::dropIfExists('supplies');
    }
}
