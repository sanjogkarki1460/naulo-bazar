<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    static $number = 1;
    return [
        'order_item'=>$number++,
        'title'=>$faker->name,
        'image'=>'1601191392.png',
        'price'=>$faker->numberBetween($min = 1000, $max = 9000),
        'previousPrice'=>$faker->numberBetween($min = 5000, $max = 12000),
        'status'=>true,
        'featured'=>false,
        'sku'=>$faker->regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'),
        'stock'=>$faker->numberBetween($min =1, $max = 50),
        'short_content'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'long_content'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'slug'=>$faker->unique()->name,
        'category_id'=>$faker->numberBetween($min =1, $max = 4),
        'market_id'=>1,
        'offer'=>'deals',
        'wholesale_quantity'=>null,
        'user_id'=>1,
        'brand_id'=>2,
        'option_group' => '{"color":[{"color":"FF0000","img":"storage\/products\/samsung-galaxy-m31-64mp-8mp-5mp-5mp\/FF0000\/1601191386.png"},{"color":"FFFFFF","img":"storage\/products\/samsung-galaxy-m31-64mp-8mp-5mp-5mp\/FFFFFF\/1601191389.png"}],"variation":[{"name":"size\/storage\/ram","value":"15 inch\/64GB\/16GB","price":"35000"},{"name":"size\/storage\/ram","value":"15Inch\/128GB\/16GB","price":"45000"}],"delivery":{"charge":"50","time":"2 - 4 days","return_policy":"10 days","homedelivery":"1","cashondelivery":"1","warrenty":"15 days"}}',
        'created_at'=>now(),
        'created_by'=>$faker->name,
    ];
});
