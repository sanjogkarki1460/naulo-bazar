<?php

namespace App\productreport;

class ProductReport implements ProductInterface
{
    /**
     *Getting the product stock report
     *
     */
    public function productStock($products)
    {
        $productStock = collect([]);
        //product stock
        foreach($products as $product){
            $productStock->prepend([
                'title' =>$product->title,
                 'stock' => $product->stock ,
                 'color' => 'rgb('.rand(0,255).','.rand(0,255).',' .rand(0,255).')'
                 ]);
        }
        return $productStock;
    }

    public function fetchTopBrowsers($data)
    {
        $browser = collect([]);
        foreach($data as $product){
            $browser->prepend([
                'browser' =>$product['browser'],
                 'sessions' => $product['sessions'] ,
                 'color' => 'rgb('.rand(0,255).','.rand(0,255).',' .rand(0,255).')'
                 ]);
        }
        return $browser;
    }
    /**
     * getting product order report
     */
    public function productOrder($order)
    {

    }

}
?>
