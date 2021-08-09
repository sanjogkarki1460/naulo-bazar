@foreach($categoryproduct as $key => $value)
<div class="product-card">
 <a href="{{route('single.product',$value->id)}}" class="d-block">
     <div class="product-card-img">
          @if(file_exists(public_path('storage/products/'.$value->slug.'/thumbs/small_'.$value->image)))
     <figure><img src="{{asset('storage/products/'.$value->slug.'/thumbs/small_'.$value->image)}}" alt=""></figure>
     @else
         <figure><img src="{{asset('frontend/images/product-1.png')}}" alt=""></figure>
     @endif
     </div>

     <div class="product-card-detail">
         <div class="product-name mb-1">
             {{$value->title}}
         </div>
         <div class="product-price d-flex align-items-center justify-content-between">
 <span class="product-price-act">
     Rs.{{$value->previousPrice}}
 </span>
             <span class="product-price-dis">
     Rs.{{$value->price}}
 </span>

         </div>
     </div>
 </a>
</div>
@endforeach
<div class="dummy"></div>
<div class="dummy"></div>
<div class="dummy"></div>
<div class="dummy"></div>