<?php

 namespace App\Filter;
 use Closure;

 class Brand{
     public function handle($request ,Closure $next){
        if(!request()->has('brand_id')){
            return $next($request);
        }

        $builder = $next($request);
        return $builder->whereIn('brand_id',request('brand_id'));
     }
 }
