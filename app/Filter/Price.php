<?php

 namespace App\Filter;
 use Closure;

 class Price{
     public function handle($request ,Closure $next){
        if(!request()->has('price')){
            return $next($request);
        }
        $builder = $next($request);
        if(request()->price[0] <= 0 && request()->price[1] <= 0){
            return $builder;
        }
        elseif(request()->price[0] > 0 && request()->price[1] <= 0 ){
            return $builder->where('unit_price','>=',request()->price[0]);
        }elseif(request()->price[0] <= 0 && request()->price[1] >= 0 ){
            return $builder->where('unit_price','<=',request()->price[1]);
        }else{
            return $builder->whereBetween('unit_price',request('price'));
        }
     }
 }
