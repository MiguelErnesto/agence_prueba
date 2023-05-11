<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section3_category_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('section3_category_id')->unsineg();
            $table->foreign('section3_category_id')->references('id')->on('section3_categories')->onDelete("cascade");
            $table->string('image');
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
        Schema::dropIfExists('section3_category_images');
    }
};
