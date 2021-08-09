@extends('layout.front')
@section('content')
<main class="no-main">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="ps-breadcrumb__list">
                <li class="active"><a href="{{route('welcome')}}">Home</a></li>
                <li class="active"><a href="{{route('category.product',$product->category->slug)}}">{{$product->category->name}}</a></li>
                @if($product->subCategory)
                <li class="active"><a href="{{route('subcategory.product',$product->subCategory->slug)}}">{{$product->subCategory->name}}</a></li>
                @endif
                <li><a href="javascript:void(0);">Hovis Onestore Soft Drinks Tea Coffee</a></li>
            </ul>
        </div>
    </div>
    
   
    <product-detail :product='{{$product}}' :images="{{$product->photos}}"></product-detail>

       @if($related_product->count()>0)
        <section class="section--product-type related-product-block">
            <div class="container">
                <div class="product__related" id="productTabDetailContent">
                    <h3 class="product__name">Related Products</h3>
                    <div class="owl-carousel" data-owl-auto="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="5" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                      @foreach($related_product as $product)
                        <div class="ps-post--product" >
                            
                            <div class="ps-product--standard"><a href="{{route('product.detail',$product->slug)}}"><img class="ps-product__thumbnail" src="{{$product->thumbnail}}" alt="alt" /></a>
                            <wishlist :product="{{$product}}"></wishlist>
                                <div class="ps-product__content">
                                    <p class="ps-product__type"><i class="icon-store"></i>{{$product->user->name}}</p>
                                    <h5><a class="ps-product__name" href="{{route('product.detail',$product->slug)}}">{{$product->name}}</a></h5>
                                    <p class="ps-product__unit">{{$product->unit}}</p>
                                    <star-rating :increment="0.2" :star-size="15" :read-only="true" :show-rating="false" :rating="{{$product->rating}}"></star-rating>
                                    
                                    <p  class="ps-product-price-block">
                                        <span class="ps-product__sale">Rs.{{$product->selling_price}}</span>
                                    @if($product->discount)
                                        <span class="ps-product__price">Rs.{{$product->unit_price}}</span>
                                    @endif
                                    </p>
                                </div>
                                <cart :product="{{$product}}"></cart>
                            </div>
                        </div>
                      @endforeach
                    </div>
                </div>
            </div>
        </section>
       @endif
    
</main>
@endsection