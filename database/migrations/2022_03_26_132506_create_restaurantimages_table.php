<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurantimages', function (Blueprint $table) {
            $table->bigIncrements('img_id');
            $table->unsignedBigInteger('restaurant_id');
            $table->string('image');
            $table->timestamps();

            $table->foreign('restaurant_id')->references('id')->on('restaurants')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurantimages');
    }
}
