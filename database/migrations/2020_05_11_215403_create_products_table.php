<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name", 64);
            $table->string("brand", 64);
            $table->unsignedDecimal("price", 8, 2);
            $table->unsignedMediumInteger("unitsPerBox");
            $table->unsignedTinyInteger("byWeight");
            $table->unsignedMediumInteger('averageSize')->nullable();
            $table->unsignedMediumInteger('provider_id');
            $table->unsignedTinyInteger("active");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
