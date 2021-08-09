<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffilateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affilate_options', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement()->unsigned();
            $table->string('type');
            $table->text('details');
            $table->double('percentage')->default(0);
            $table->boolean('status')->default(1)->nullable();
            $table->timestamps();
        });
    }
    // `id`
    // `type` 
    // `details
    // `percentage`
    //  `status`
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affilate_options');
    }
}
