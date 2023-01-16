<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_name', 250)->default('');
            $table->string('image_url', 500)->default('');
            $table->string('city', 250)->default('');
            $table->string('address', 250)->default('');
            $table->text('description');
            $table->integer('stars')->default(0);
            $table->string('latitude', 250)->default('');
            $table->string('longitude', 250)->default('');
            $table->softDeletes();
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
        Schema::dropSoftDeletes();
    }
}
