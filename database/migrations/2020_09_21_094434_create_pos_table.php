<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_name');
            $table->unsignedBigInteger('user_id');
            $table->integer('order_no')->unique();
            $table->text('products')->nullable();
            $table->integer('total_price');
            $table->text('billing_details');
            $table->bigInteger('tax')->nullable();
            $table->string('payment_method')->nullable();
            $table->text('shipping_details');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('pos');
    }
}
