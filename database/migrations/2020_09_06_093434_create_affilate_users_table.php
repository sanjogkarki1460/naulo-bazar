<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffilateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affilate_users', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement()->unsigned();
            $table->string('email');
            $table->string('payment_method');
            $table->string('bank_information');
            $table->unsignedBigInteger('user_id');
            $table->boolean('status')->default(0);
            $table->double('balance', 10, 2);
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
        Schema::dropIfExists('affilate_users');
    }
}
