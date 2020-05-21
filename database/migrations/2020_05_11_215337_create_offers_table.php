<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger("product_id")->nullable();
            $table->unsignedInteger("paymentMethod_id")->nullable();
            $table->string("discountType", 16);
            $table->decimal("discountAmount", 8, 2);
            $table->date("expirationDate")->nullable();
            $table->unsignedTinyInteger("byProduct");
            $table->unsignedTinyInteger("byPayment");
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
        Schema::dropIfExists('offers');
    }
}
