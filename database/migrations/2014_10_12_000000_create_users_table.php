<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_name')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('referral_code')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('ip_address')->nullable();
            $table->tinyInteger('verified')->default(false);
            $table->string('verification_token')->nullable();
            $table->string('phone_number')->unique();
            $table->tinyInteger('isActive')->default(1);
            $table->unsignedInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('recurrent_order_id')->nullable();
            $table->foreign('recurrent_order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('users');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
