<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('items');
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_name');
            $table->integer('number_in_stock')->unsigned();
            $table->string('item_category');
            $table->integer('item_price')->unsigned();
            $table->string('sku')->nullable();
            $table->integer('discount')->nullable();
            $table->string('tax')->nullable();
            $table->string('description');
            $table->string('image_path')->nullable();
            $table->string('slug');
            $table->tinyInteger('isAvaliable')->default(1);
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('items');
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }
}
