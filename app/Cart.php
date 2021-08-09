<?php

namespace App;
use Illuminate\Support\Str;
class Cart
{
    public $items =null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $delivery_charge = 0;
    public function __construct($oldCart)
    {
     
        if($oldCart)
        {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->delivery_charge = $oldCart->delivery_charge;
            
        }
    }

    public function create($item,$id,$quantity,$variation)
    {
        $storedItems = ['qty'=>0,'items'=>$item,'price'=>$this->totalPrice,'variation'=>$variation,'delivery_charge' => json_decode($item->option_group)->delivery->charge,'image'=>null ];
        
        if($this->items)
        {
            
            if(array_key_exists($id,$this->items) && $this->items[$id]['variation'] == json_decode($variation))
            {
                
                $storedItems = $this->items[$id];
                $this->update($item,$id,$quantity,$variation,$storedItems);
                // $this->totalPrice = $this->totalPrice - $this->oldCart->price;
                // $this->totalPrice += $storedItems->price;

            }
            else
            {
                
                $this->addVariation($item,$id,$quantity,$variation,$storedItems);
            }
            
           
        }
        else
        {
            $this->add($item,$id,$quantity,$variation,$storedItems);
        }
        
 
       
    }

    public function add($item,$id,$quantity,$variation,$storedItems)
    {
       
        $storedItems['qty'] += $quantity;
        $storedItems['variation'] = json_decode($variation);
        if(isset($storedItems['variation']))
        {
            
            $storedItems['price'] = $storedItems['variation']->price * $storedItems['qty'];
        }
        else
        {
            $storedItems['price'] = $item->price * $storedItems['qty'];
        }
        $storedItems['delivery_charge'] = json_decode($item->option_group)->delivery->charge;
        
        $this->delivery_charge += json_decode($item->option_group)->delivery->charge; 
        $this->items[$id] = $storedItems;
        $this->totalQty += $quantity;
        if(isset($storedItems['variation']))
        {
            $storedItems['price'] = $storedItems['variation']->price;
            $this->totalPrice += $storedItems['variation']->price * $quantity;
        }
        else{
            $this->totalPrice += $item->price * $quantity;
        }
        
      
    }
    public function addVariation($item,$id,$quantity,$variation,$storedItems)
    {
       
        $storedItems['qty'] += $quantity;
        $storedItems['variation'] = json_decode($variation);
        if(isset($storedItems['variation']))
        {
            
            $storedItems['price'] = $storedItems['variation']->price * $storedItems['qty'];
        }
        else
        {
            $storedItems['price'] = $item->price * $storedItems['qty'];
        }
        $storedItems['delivery_charge'] = json_decode($item->option_group)->delivery->charge;
        $this->delivery_charge += 0; 
        $this->items[$id] = $storedItems;
        $this->totalQty += $quantity;
        if(isset($storedItems['variation']))
        {
            $this->totalPrice = $this->totalPrice - $this->items[$id]['price'];
            $this->totalQty = $this->totalQty - $this->items[$id]['qty'];
             $this->totalPrice += $storedItems['variation']->price * $quantity;
             $this->totalQty += $quantity;
        }
        else{
            $this->totalPrice += $item->price * $quantity;
        }
        
      
    }

    public function update($item,$id,$quantity,$variation,$storedItems)
    {
        $storedItems['qty'] += $quantity;
        $storedItems['variation'] = json_decode($variation);
        if(isset($storedItems['variation']))
        {
            
            $storedItems['price'] = $storedItems['variation']->price * $storedItems['qty'];
        }
        else
        {
            $storedItems['price'] = $item->price * $storedItems['qty'];
        }
       
       
        $this->items[$id] = $storedItems;
        $this->totalQty += $quantity;
        if(isset($storedItems['variation']))
        {
            $this->totalPrice += $storedItems['variation']->price * $quantity;
        }
        else{
            $this->totalPrice += $item->price * $quantity;
        }
    }


}
