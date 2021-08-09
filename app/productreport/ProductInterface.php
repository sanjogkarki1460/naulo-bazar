<?php

namespace App\productreport;

interface ProductInterface
{
    /**
     *Getting the product stock
     *
     */
    public function productStock($product);

    public function productOrder($order);

}
?>
