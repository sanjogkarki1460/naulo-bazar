<?php

 namespace App\Filter;
 use Closure;

 class Sort{
     public function handle($request ,Closure $next){
        if(! request()->has('sort')){
            return $next($request);
        }
        elseif(request('sort') == 1){
            $builder = $next($request);
            return $builder->orderBy('unit_price','desc');

        }elseif(request('sort') == 2){
            $builder = $next($request);
            return $builder->orderBy('unit_price','asc');
            
        }elseif(request('sort') == 3){
            $builder = $next($request);
            return $builder->orderBy('created_at','desc');

        }elseif(request('sort') == 4){
            $builder = $next($request);
            return $builder->orderBy('created_at','asc');

        }else{
            $builder = $next($request);
            return $builder->latest();
        }
     }
 }
