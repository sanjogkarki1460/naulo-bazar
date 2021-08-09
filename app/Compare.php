<?php

namespace App;

class Compare
{
    public $totalCompare = 0;
    public $items;
    public function __construct($oldCompare)
    {
        if($oldCompare)
        {
            $this->items = $oldCompare->items;

        }
    }

    public function create($id,$items)
    {
        $storedItems = ['totalCompare'=>0,'items'=>$items];

        if($this->items)
        {
            if(array_key_exists($id,$this->items))
            {
                $storedItems = $this->items[$id];
            }
        }
        $storedItems['totalCompare']++;
        $this->items[$id] = $storedItems;
        $this->totalCompare += $storedItems['totalCompare'];
    }
}