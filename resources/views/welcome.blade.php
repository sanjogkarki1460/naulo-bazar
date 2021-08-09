@extends('layout.front')
@section('content')
<!-- banner section -->
@if($banners->count() >0)
<div class="section-slide--default">
    <div class="owl-carousel" data-owl-auto="false" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
        @foreach($banners as $banner)
        <div  class="ps-banner"><img class="mobile-only" src="assets/img/slider/home-dark/slide-mobile-01.jpg" alt="alt" />
          <img class="desktop-only" src="{{asset($banner->photo)}}" alt="alt" />
            <div class="ps-content">
                <div class="container">
                    <div class="ps-content-box">
                        <div class="ps-node">MART FROM ONE STORE</div>
                        <div class="ps-title">Welcome to <b class='text-success'>Onestore</b> Foods & Organic Online.</div>
                        <div class="ps-subtitle">* Free delivery for your first order</div>
                        <div class="ps-shopnow"> <a href="{{$banner->url}}">Shop Now<i class="icon-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
<!-- end of banner section -->

<!-- start category section -->
@if($category->count() > 0)
<section class="ps-component ps-component--category">
    <div class="container">
        <div class="component__header">
            <!-- <h3 class="component__title">Shop By Category</h3><a class="component__view" href="shop-categories.html">View All <i class="icon-chevron-right"></i></a> -->
        </div>
        <div class="component__content">
            <div class="owl-carousel" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="8" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="5" data-owl-item-lg="8" data-owl-duration="1000" data-owl-mousedrag="on">
                @foreach($category as $cat)
                <div class="ps-category__item"><a href="{{route('category.product',$cat->slug)}}"><img class="ps-categories__thumbnail" src="{{$cat->icon}}" alt></a><a class="ps-categories__name" href="shop-categories.html">{{$cat->name}} </a></div>
               @endforeach
            </div>
        </div>
    </div>
</section>
@endif
<!-- end category section -->

<!-- top offer section  -->
<!-- <section class="ps-component">
      <div class="container">
          <div class="component__header">
              <h3 class="component__title">Top Greatest Offers</h3>
              <a class="component__view" href="shop-categories.html">View All <i class="icon-chevron-right"></i></a>
          </div>
          <div class="component__content promotion__carousel">
              <div class="owl-carousel" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="2" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                  <div class="promotion__thumbnail"><a href="index.html"><img src="assets/img/promotion/promotion_01.jpg" alt></a></div>
                  <div class="promotion__thumbnail"><a href="index.html"><img src="assets/img/promotion/promotion_02.jpg" alt></a></div>
                  <div class="promotion__thumbnail"><a href="index.html"><img src="assets/img/promotion/promotion_03.jpg" alt></a></div>
                  <div class="promotion__thumbnail"><a href="index.html"><img src="assets/img/promotion/promotion_01.jpg" alt></a></div>
              </div>
          </div>
      </div>
  </section> -->
<!-- end of top offer section -->

<!-- flash sell section -->

@if($flashDeal)
<section class="ps-component ps-component--flash">
    <div class="container">
        <div class="component__header">
            <h3 class="component__title">Today Flash Sale<span class="ps-countdown"><span class="ps-countdown-end">Ends in : </span><span class="ps-countdown"><b class="hours">2</b> hours : <b class="minutes">12</b> mins : <b class="seconds">45</b> secs</span><span class="ps-countdown mobile"><b class="hours">00</b> h : <b class="minutes">20</b> m : <b class="seconds">45</b> s</span></span></h3>
            <a class="component__view" href="{{route('flash.product')}}">View All <i class="icon-chevron-right"></i></a>
        </div>
        <div class="component__content">
            <div class="owl-carousel" data-owl-auto="true"  data-owl-speed="8000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="false" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="5" data-owl-duration="1000" data-owl-mousedrag="on">
                @foreach($flashDeal->flash_deal_products as $flash_deal)
                
                <div class="ps-flash__product">
                    <div class="ps-product--standard"><a href="{{route('product.detail',$flash_deal->product->slug)}}"><img class="ps-product__thumbnail" src="{{$flash_deal->product->thumbnail}}" alt="alt" />
                    </a>
                    <!-- <triger-model :product="{{$flash_deal->product}}"></triger-model> -->
                        <div class="ps-product__content">
                            <p class="ps-product__type"><i class="icon-store"></i>{{$flash_deal->product->user->name}}</p>
                            <h5><a class="ps-product__name" href="{{route('product.detail',$flash_deal->product->slug)}}">{{$flash_deal->product->name}}</a></h5>
                            <p class="ps-product__unit">{{$flash_deal->product->unit}}</p>
                            <star-rating :increment="0.2" :star-size="15" :read-only="true" :show-rating="false" :rating="{{$flash_deal->product->rating}}"></star-rating>
                            <p class="ps-product-price-block"><span class="ps-product__sale">Rs{{$flash_deal->product->selling_price}}</span>
                            @if($flash_deal->product->discount)
                            <span class="ps-product__price">Rs{{$flash_deal->product->unit_price}}</span>
                            @endif
                            </p>
                            <!-- <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> -->
                            <!-- <p class="ps-product__sold">Sold: 0/40</p> -->
                        </div>
                        
                        <cart :product="{{$flash_deal->product}}"></cart>
                        
                    </div>
                </div>
                
                @endforeach
                
            </div>
        </div>
    </div>
    <flash-model ></flash-model>

</section>

@endif
<!-- flash sell section end -->

<!-- best selling section -->
@if($bestSelling->count() >0)
 <section class="ps-component ps-component--selling">
    <div class="container">
        <div class="component__header">
            <h3 class="component__title">Top Best Selling Items</h3>
            <!-- <a class="component__view" href="shop-categories.html">View All <i class="icon-chevron-right"></i></a> -->
        </div>
        <div class="component__content">
            <div class="owl-carousel" data-owl-auto="true" data-owl-loop="false" data-owl-speed="12000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="5" data-owl-duration="1000" data-owl-mousedrag="on">
               @foreach($bestSelling as $product)
                <div  class="ps-sell__product">
                    <div class="ps-product--standard"><a href="{{route('product.detail',$product->slug)}}"><img class="ps-product__thumbnail" src="{{$product->thumbnail}}" alt="alt" /></a>
                    <wishlist :product="{{$product}}"></wishlist>
                    <!-- <span class="ps-badge ps-product__offbadge">35% Off </span> -->
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
<!-- end of best selling section -->


<!-- recommended section -->

@if($recommended->count()>0 )
<section class="section-recommendations--default">
    <div class="container">
        <div class="recommendations__header">
            <h3 class="recommendations__title">Recommendations</h3>
        </div>
        <div class="recommendations__content">
            <div class="owl-carousel" data-owl-auto="true" data-owl-loop="false" data-owl-speed="15000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="5" data-owl-duration="1000" data-owl-mousedrag="on">
                @foreach($recommended as $product)
                <div class="ps-recommendation__product">
                    <div class="ps-product--standard"><a href="{{route('product.detail',$product->slug)}}"><img class="ps-product__thumbnail" src="{{$product->thumbnail}}" alt="alt" /></a>
                    <wishlist :product="{{$product}}"></wishlist>
                        <div class="ps-product__content">
                            <p class="ps-product__type"><i class="icon-store"></i>{{$product->user->name}}</p>
                            <h5><a class="ps-product__name" href="{{route('product.detail',$product->slug)}}">{{$product->name}}</a></h5>
                            <p class="ps-product__unit">{{$product->unit}}</p>
                            <star-rating :increment="0.2" :star-size="15" :read-only="true" :show-rating="false"  :rating="{{$product->rating}}"></star-rating>
                            <p class="ps-product-price-block"><span class="ps-product__price-default">Rs{{$product->selling_price}}</span>
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
<!-- just for you section -->
<just-for-you ></just-for-you>
<!-- end of just for you section -->

<!-- other section -->
<section class="ps-promotion--default">
                <div class="container">
                    <div class="row m-0">
                        <div class="col-6 col-lg-3"><a href="shop-view-grid.html"><img src="{{asset('assets/img/promotion/home-dark-promo-01.jpg')}}" alt="alt"></a></div>
                        <div class="col-6 col-lg-3"><a href="shop-view-grid.html"><img src="{{asset('assets/img/promotion/home-dark-promo-02.jpg')}}" alt="alt"></a></div>
                        <div class="col-6 col-lg-3"><a href="shop-view-grid.html"><img src="{{asset('assets/img/promotion/home-dark-promo-03.jpg')}}" alt="alt"></a></div>
                        <div class="col-6 col-lg-3"><a href="shop-view-grid.html"><img src="{{asset('assets/img/promotion/home-dark-promo-04.jpg')}}" alt="alt"></a></div>
                    </div>
                </div>
            </section>
            @if($topVendors->count()>0)
            <section  class="ps-component ps-component--blog">
                <div class="container">
                    <div class="component__header">
                        <h3 class="component__title">Our Top Venders</h3>
                    </div>
                    <div class="component__content">
                        <div class="owl-carousel" data-owl-auto="true"  data-owl-speed="8000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="2" data-owl-item-lg="4" data-owl-item-xl="4" data-owl-duration="1000" data-owl-mousedrag="on">
                            @foreach($topVendors as $vendor)
                            <div  class="ps-post--related">
                                <div class="post__img"><a href="{{route('vendor.detail',$vendor->id)}}">
                                @if($vendor->shop)
                                <img src="{{$vendor->shop->shop_logo}}" alt="alt" />
                                @else
                                <img src="{{$vendor->user_avatar}}" alt="alt" />
                                @endif
                                </a></div>
                                <div class="post__content">
                                    <div class="post__archives"><a class="archive__item post__type" href="{{route('vendor.detail',$vendor->id)}}"><i class="icon-folder"></i>{{$vendor->city}}</a></div><a class="post__title" href="{{route('vendor.detail',$vendor->id)}}">
                                    @if($vendor->shop)
                                    {{$vendor->shop->name}}
                                    @else
                                    {{$vendor->name}}
                                    @endif
                                    </a>
                                    <p class="post__date"> <i class="icon-calendar-full"></i>{{$vendor->created_at->diffForHumans()}} <a class="text-success" href="{{route('vendor.detail',$vendor->id)}}">{{$vendor->name}}</a></p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            @endif
            <!-- <section class="ps-component ps-component--customer">
                <div class="container">
                    <div class="component__header">
                        <h3 class="component__title">Our Happy customers</h3>
                    </div>
                    <div class="component__content">
                        <div class="owl-carousel" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="2" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="2" data-owl-item-lg="2" data-owl-item-xl="2" data-owl-duration="1000" data-owl-mousedrag="on">
                            <div class="ps-customer--block">
                                <div class="ps-customer__thumbnail"><img src="assets/img/blogs/customer-01.png" alt></div>
                                <div class="ps-customer__content"><i class="ps-customer__icon icon-quote-open"></i>
                                    <h4 class="ps-customer__name">Bikash Bhandari / <span class="ps-customer__position">MD at Tejobindu Solutions.</span></h4>
                                    <p class="ps-customer__des">“You won't regret it. It's really wonderful. I made back the purchase price in just 48 hours! Your company is truly upstanding and is behind its product 100%.“</p>
                                </div>
                            </div>
                            <div class="ps-customer--block">
                                <div class="ps-customer__thumbnail"><img src="assets/img/blogs/customer-02.png" alt></div>
                                <div class="ps-customer__content"><i class="ps-customer__icon icon-quote-open"></i>
                                    <h4 class="ps-customer__name">Sangita Dhital / <span class="ps-customer__position">Housewife</span></h4>
                                    <p class="ps-customer__des">“It's really wonderful. I'd be lost without Farmart. I love Farmart. I am completely blown away.“</p>
                                </div>
                            </div>
                            <div class="ps-customer--block">
                                <div class="ps-customer__thumbnail"><img src="assets/img/blogs/post_auth.png" alt></div>
                                <div class="ps-customer__content"><i class="ps-customer__icon icon-quote-open"></i>
                                    <h4 class="ps-customer__name">Bipin Dhakal / <span class="ps-customer__position">CEO at Tejobindu Solutions.</span></h4>
                                    <p class="ps-customer__des">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->

            <section class="ps-home--block">
                <div class="container">
                    <div class="ps-block--promo"><a href="{{route('store')}}"><img class="desktop-only" src="assets/img/promotion/promo-03.jpg" alt=""></a><a href="shop-view-grid.html"><img class="mobile-only" src="" alt=""></a></div>
                </div>
            </section>
            @if(!auth()->check())
            <section class="ps-component--register" >
                <div class="container">
                    <h3 class="component__title">Get started to One Store! Your first delivery is free</h3>
                    <p>Join other shoppers in your area, and try farmart.com today.</p><a class="ps-button" href="{{route('customer.signup')}}">Register An Account</a>
                </div>
            </section>
            @endif
            <!-- flash deal model -->
            
            <!-- flash deal model  -->
            <!-- <div class="modal fade" id="popupAddToCart" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl ps-addcart">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="alert__success"><i class="icon-checkmark-circle"></i> "Morrisons The Best Beef Topside" successfully added to you cart. <a href="shopping-cart.html">View cart(3)</a></div>
                                <hr>
                                <h3 class="cart__title">CUSTOMERS WHO BOUGHT THIS ALSO BOUGHT:</h3>
                                <div class="cart__content">
                                    <div class="owl-carousel" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="true" data-owl-item="4" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="2" data-owl-item-lg="4" data-owl-item-xl="4" data-owl-duration="1000" data-owl-mousedrag="on">
                                        <div class="cart-item">
                                            <div class="ps-product--standard"><a href="product_details.html"><img class="ps-product__thumbnail" src="assets/img/products/07-beer-winespirits/07_10a.jpg" alt="alt" /></a>
                                                <div class="ps-product__content">
                                                    <p class="ps-product__type"><i class="icon-store"></i>OneStoreMart</p><a href="product_details.html">
                                                        <h5 class="ps-product__name">Extreme Budweiser Light Can</h5>
                                                    </a>
                                                    <p class="ps-product__unit">500g</p>
                                                    <div class="ps-product__rating">
                                                        <select class="rating-stars">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4" selected="selected">4</option>
                                                            <option value="5">5</option>
                                                        </select><span>(4)</span>
                                                    </div>
                                                    <p class="ps-product-price-block"><span class="ps-product__sale">Rs8.90</span><span class="ps-product__price">Rs9.90</span><span class="ps-product__off">15% Off</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart-item">
                                            <div class="ps-product--standard"><a href="product_details.html"><img class="ps-product__thumbnail" src="assets/img/products/01-fresh/01_16a.jpg" alt="alt" /></a>
                                                <div class="ps-product__content">
                                                    <p class="ps-product__type"><i class="icon-store"></i>Karery Store</p><a href="product_details.html">
                                                        <h5 class="ps-product__name">Honest Organic Still Lemonade</h5>
                                                    </a>
                                                    <p class="ps-product__unit">100g</p>
                                                    <div class="ps-product__rating">
                                                        <select class="rating-stars">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5" selected="selected">5</option>
                                                        </select><span>(14)</span>
                                                    </div>
                                                    <p class="ps-product-price-block"><span class="ps-product__price-default">Rs1.99</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart-item">
                                            <div class="ps-product--standard"><a href="product_details.html"><img class="ps-product__thumbnail" src="assets/img/products/07-beer-winespirits/07_10a.jpg" alt="alt" /></a>
                                                <div class="ps-product__content">
                                                    <p class="ps-product__type"><i class="icon-store"></i>Ganesh Farm</p><a href="product_details.html">
                                                        <h5 class="ps-product__name">Natures Own 100% Wheat</h5>
                                                    </a>
                                                    <p class="ps-product__unit">100g</p>
                                                    <div class="ps-product__rating">
                                                        <select class="rating-stars">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select><span>(0)</span>
                                                    </div>
                                                    <p class="ps-product-price-block"><span class="ps-product__price-default">Rs4.49</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart-item">
                                            <div class="ps-product--standard"><a href="product_details.html"><img class="ps-product__thumbnail" src="assets/img/products/01-fresh/01_15a.jpg" alt="alt" /></a>
                                                <div class="ps-product__content">
                                                    <p class="ps-product__type"><i class="icon-store"></i>OneStoreMart</p><a href="product_details.html">
                                                        <h5 class="ps-product__name">Avocado, Hass Large</h5>
                                                    </a>
                                                    <p class="ps-product__unit">300g</p>
                                                    <div class="ps-product__rating">
                                                        <select class="rating-stars">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3" selected="selected">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select><span>(6)</span>
                                                    </div>
                                                    <p class="ps-product-price-block"><span class="ps-product__sale">Rs6.99</span><span class="ps-product__price">Rs9.90</span><span class="ps-product__off">25% Off</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart-item">
                                            <div class="ps-product--standard"><a href="product_details.html"><img class="ps-product__thumbnail" src="assets/img/products/07-beer-winespirits/07_10a.jpg" alt="alt" /></a>
                                                <div class="ps-product__content">
                                                    <p class="ps-product__type"><i class="icon-store"></i>Sun Farm</p><a href="product_details.html">
                                                        <h5 class="ps-product__name">Kevita Kom Ginger</h5>
                                                    </a>
                                                    <p class="ps-product__unit">200g</p>
                                                    <div class="ps-product__rating">
                                                        <select class="rating-stars">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4" selected="selected">4</option>
                                                            <option value="5">5</option>
                                                        </select><span>(6)</span>
                                                    </div>
                                                    <p class="ps-product-price-block"><span class="ps-product__sale">Rs4.90</span><span class="ps-product__price">Rs3.99</span><span class="ps-product__off">15% Off</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
@endsection
