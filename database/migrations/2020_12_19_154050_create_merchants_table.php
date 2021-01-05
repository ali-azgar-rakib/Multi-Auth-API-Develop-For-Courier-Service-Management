<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('shop_name')->nullable();
            $table->string('shop_category')->nullable();
            $table->string('pickup_zone')->nullable();
            $table->string('pickup_address')->nullable();
            $table->string('pickup_phone')->nullable();
            $table->string('bank_no')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bkash')->nullable();
            $table->string('rocket')->nullable();
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
        Schema::dropIfExists('merchants');
    }
}
