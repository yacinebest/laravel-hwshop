<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            // $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->string('firstname');
            $table->string('lastname');
            $table->string('username');
            $table->string('address')->nullable();


            $table->date('birth_date')->nullable();
            $table->enum('gender',['MALE','FEMALE'])->nullable();
            $table->string('country')->nullable();
            $table->string('phone_number')->nullable();

            $table->string('avatar')->default('default.jpg');
            $table->uuid('role_id')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
