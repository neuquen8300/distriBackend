<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name", 64);
            $table->string("businessName", 64)->nullable();
            $table->string("cuit", 64)->nullable();
            $table->unsignedTinyInteger("clientType_id");
            $table->decimal("balance", 8, 2);
            $table->unsignedBigInteger("location_id")->nullable();
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
        Schema::dropIfExists('clients');
    }
}
