<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("address", 64);
            $table->string("zipCode", 8);
            $table->string("city", 32);
            $table->string("province", 32);
            $table->string("country", 32);
            $table->string('locationBelongsTo', 32);
            $table->unsignedBigInteger('reference_id');
            $table->unsignedTinyInteger('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
