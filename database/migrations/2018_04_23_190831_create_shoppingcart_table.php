<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingcartTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::create('shoppingcarts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->jsonb('content');
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::drop('shoppingcarts');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
