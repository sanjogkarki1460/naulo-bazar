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
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('added_by')->default('admin');
            $table->string('slug')->unique();
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('subsubcategory_id');
            $table->longText('photos')->nullable();
            $table->string('thumbnail_img')->nullable();
            $table->string('featured_img')->nullable();
            $table->string('flash_deal_img')->nullable();
            $table->string('video_provider')->nullable();
            $table->string('video_link')->nullable();
            $table->mediumText('tags')->nullable();
            $table->longText('description')->nullable();
            $table->double('unit_price')->nullable();
            $table->double('purchase_price')->nullable();
            $table->integer('variant_product')->default(0);
            $table->text('attributes')->nullable();
            $table->text('choice_options')->nullable();
            $table->mediumText('colors')->nullable();
            $table->text('variations')->nullable();
            $table->boolean('todays_deal')->default(1);
            $table->integer('published')->default(1);
            $table->integer('featured')->default(0);
            $table->string('unit')->nullable();
            $table->double('discount')->nullable();
            $table->string('discount_type')->nullable();
            $table->double('tax')->nullable();
            $table->string('tax_type')->nullable();
            $table->string('shipping_type')->nullable()->default('flat_rate');
            $table->double('shipping_cost')->nullable()->default(0.00);
            $table->integer('current_stock')->default(0);
            $table->integer('commission')->nullable();

            $table->string('pdf')->nullable();
            $table->integer('num_of_sale')->default(0);
            $table->text('meta_description')->nullable();
            $table->integer('refundable')->default(0);
            $table->mediumText('meta_title')->nullable();
            $table->string('meta_img')->nullable();
            $table->string('barcode')->nullable();
            $table->integer('digital')->default(0);
            $table->integer('user_id')->unsigned();
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->integer('brand_id')->unsigned();
            // $table->foreign('brand_id')->references('id')->on('brands');
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
        Schema::dropIfExists('products');
    }
}
