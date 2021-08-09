<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table)
        {
            $table->bigIncrements('id')->autoIncrement()->unsigned();
            $table->string('title');
            $table->text('description');
            $table->string('coupon_code');
            $table->string('type');
            $table->unsignedBigInteger('user_id');
            $table->boolean('status')->default('0');
            $table->integer('discount_value')->nullable();
            $table->string('max_discount_value')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('uses_per_coupon')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
