<section id="deal">
    <div class="container">
        <div class="row justify-content-between">
            <div class="title text-center p-2 gry-bg">
                <h3 class="heading-6 mb-0">
                    {{ __('Todays Deal') }}
                    <span class="badge badge-danger">{{__('Hot')}}</span>
                </h3>
            </div>
            <a href="{{route('dealsproducts')}}" class="btn btn-primary ">
                View more
            </a>
        </div>
        <div class="row mt-5">

            <div class="product product-carousel owl-carousel owl-theme">
                @foreach (\App\Models\Product::where('published', 1)->where('todays_deal', '1')->get() as $key => $product)
                    @if ($product != null)
                        <div class="product-card">
                            <a href="{{ route('single.product', $product->slug) }}" class="d-block">
                                <div class="product-card-img">
                                    @if(file_exists(public_path('storage/products/'.$product->slug.'/thumbs/small_'.$product->image)))
                                        <figure><img
                                                    src="{{asset('storage/products/'.$product->slug.'/thumbs/small_'.$product->image)}}"
                                                    alt=""></figure>
                                    @else
                                        <figure><img src="{{asset('frontend/images/product-1.png')}}" alt=""></figure>
                                    @endif
                                </div>

                                <div class="product-card-detail">
                                    <div class="row">
                                        <div class="product-name mb-1 ml-2">
                                            {{$product->name}}
                                        </div>
                                        <div class="star-rating star-rating-sm pl-2">
                                            {{ renderStarRating($product->rating) }}
                                        </div>
                                    </div>
                                    <div class="product-price d-flex align-items-center justify-content-between">
                                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                            <span class="product-price-act">
                                              {{ home_discounted_base_price($product->id) }}
                                            </span>
                                            <span class="product-price-dis">
                                                <del>   {{ home_base_price($product->id) }}  </del>
                                            </span>
                                        @endif
                                    </div>

                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

@php
    $flash_deal = \App\Models\FlashDeal::where('status', 1)->where('featured', 1)->first();
@endphp
@if($flash_deal != null && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date)
    <section id="deal">
        <div class="container">
            <div class="row justify-content-between">
                <div class="title">
                    <h3>
                        Flash Sale
                    </h3>
                    <div class="flash-deal-box float-left">
                        <div class="countdown countdown--style-1 countdown--style-1-v1 "
                             data-countdown-date="{{ date('m/d/Y', $flash_deal->end_date) }}"
                             data-countdown-label="show"></div>
                    </div>
                    <ul class="inline-links float-right">
                        <li><a href="{{ route('flash-deal-details', $flash_deal->slug) }}" class="active">View More</a>
                        </li>
                    </ul>

                </div>
                <a href="{{route('hotproducts')}}" class="btn btn-primary ">
                    View more
                </a>
            </div>
            <div class="row mt-5">

                <div class=" product product-carousel owl-carousel owl-theme">
                    @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                        @php
                            $product = \App\Models\Product::find($flash_deal_product->product_id);
                        @endphp
                        @if ($product != null && $product->published != 0)
                            <div class="product-card">
                                <a href="{{route('single.product',$hotproduct->slug)}}" class="d-block">
                                    <div class="product-card-img">
                                        <img class="img-fit lazyload mx-auto"
                                             src="{{ asset('frontend/images/placeholder.jpg') }}"
                                             data-src="{{ asset($product->flash_deal_img) }}"
                                             alt="{{ __($product->name) }}">
                                    </div>

                                    <div class="product-card-detail">
                                        <div class="product-name mb-1">
                                            {{$hotproduct->title}}
                                        </div>
                                        <div class="product-price d-flex align-items-center justify-content-between">
                                            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                <span class="product-price-dis">
                                                    {{ home_discounted_base_price($product->id) }}
                                    </span>
                                            @endif
                                            <span class="product-price-act">
                           <del>          {{ home_base_price($product->id) }}
                                    </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif



<div id="section_featured">

</div>

<div id="section_best_selling">

</div>

<div id="section_home_categories">

</div>

{{--@if(\App\Models\BusinessSetting::where('type', 'classified_product')->first()->value == 1)--}}
{{--    @php--}}
{{--        $customer_products = \App\Models\CustomerProduct::where('status', '1')->where('published', '1')->take(10)->get();--}}
{{--    @endphp--}}
{{--    @if (count($customer_products) > 0)--}}
{{--        <section class="mb-4">--}}
{{--            <div class="container">--}}
{{--                <div class="px-2 py-4 p-md-4 bg-white shadow-sm">--}}
{{--                    <div class="section-title-1 clearfix">--}}
{{--                        <h3 class="heading-5 strong-700 mb-0 float-left">--}}
{{--                            <span class="mr-4">{{__('Classified Ads')}}</span>--}}
{{--                        </h3>--}}
{{--                        <ul class="inline-links float-right">--}}
{{--                            <li><a href="{{ route('customer.products') }}" class="active"--}}
{{--                                   style="background: #EB2329; border-color: #EB2329;">{{__('View More')}}</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="caorusel-box arrow-round">--}}
{{--                        <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"--}}
{{--                             data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">--}}
{{--                            @foreach ($customer_products as $key => $customer_product)--}}
{{--                                <div class="product-card-2 card card-product my-2 mx-1 mx-sm-2 shop-cards shop-tech">--}}
{{--                                    <div class="card-body p-0">--}}
{{--                                        <div class="card-image">--}}
{{--                                            <a href="{{ route('customer.product', $customer_product->slug) }}"--}}
{{--                                               class="d-block">--}}
{{--                                                <img class="img-fit lazyload mx-auto"--}}
{{--                                                     src="{{ asset('frontend/images/placeholder.jpg') }}"--}}
{{--                                                     data-src="{{ asset($customer_product->thumbnail_img) }}"--}}
{{--                                                     alt="{{ __($customer_product->name) }}">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}

{{--                                        <div class="p-sm-3 p-2">--}}
{{--                                            <div class="price-box">--}}
{{--                                                <span class="product-price strong-600">{{ single_price($customer_product->unit_price) }}</span>--}}
{{--                                            </div>--}}
{{--                                            <h2 class="product-title p-0 text-truncate-1">--}}
{{--                                                <a href="{{ route('customer.product', $customer_product->slug) }}">{{ __($customer_product->name) }}</a>--}}
{{--                                            </h2>--}}
{{--                                            <div>--}}
{{--                                                @if($customer_product->conditon == 'new')--}}
{{--                                                    <span class="product-label label-hot">{{__('new')}}</span>--}}
{{--                                                @elseif($customer_product->conditon == 'used')--}}
{{--                                                    <span class="product-label label-hot">{{__('Used')}}</span>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    @endif--}}
{{--@endif--}}


{{--@if($markets)--}}
{{--    <section id="deal">--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-center">--}}
{{--                <div class="title">--}}
{{--                    <h3>--}}
{{--                        Store Followed--}}
{{--                    </h3>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @foreach($markets as $market)--}}
{{--                @if($market != null)--}}
{{--                    @if($market->product->isNotEmpty())--}}
{{--                        <div class="row mt-5 justify-content-between">--}}
{{--                            <div class="title">--}}
{{--                                <h3>--}}
{{--                                    {{$market->name}}--}}
{{--                                </h3>--}}
{{--                            </div>--}}
{{--                            <a href="{{route('dealsproducts')}}" class="btn btn-primary ">--}}
{{--                                View more--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="row mt-5">--}}

{{--                            <div class="product product-carousel owl-carousel owl-theme">--}}


{{--                                @foreach($market->product as $key => $product)--}}
{{--                                    <div class="product-card">--}}

{{--                                        <a href="{{route('single.product',['product'=> $product->slug])}}"--}}
{{--                                           class="d-block">--}}
{{--                                            <div class="product-card-img">--}}
{{--                                                @if(file_exists(public_path('storage/products/'.$product->slug.'/thumbs/small_'.$product->image)))--}}
{{--                                                    <figure><img--}}
{{--                                                                src="{{asset('storage/products/'.$product->slug.'/thumbs/small_'.$product->image)}}"--}}
{{--                                                                alt=""></figure>--}}
{{--                                                @else--}}
{{--                                                    <figure><img src="{{asset('frontend/images/product-1.png')}}"--}}
{{--                                                                 alt="">--}}
{{--                                                    </figure>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}

{{--                                            <div class="product-card-detail">--}}
{{--                                                <div class="product-name mb-1">--}}
{{--                                                    {{$product->title}}--}}
{{--                                                </div>--}}
{{--                                                <div class="product-price d-flex align-items-center justify-content-between">--}}
{{--                                    <span class="product-price-act">--}}
{{--                                        Rs.{{$product->previousPrice}}--}}
{{--                                    </span>--}}
{{--                                                    <span class="product-price-dis">--}}
{{--                                       <del> Rs.{{$product->price}} </del>--}}
{{--                                    </span>--}}

{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}


{{--                            </div>--}}

{{--                        </div>--}}
{{--                    @endif--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <div class="row justify-content-center">--}}
{{--        <div class="title">--}}
{{--            <h3>--}}
{{--                Just For You--}}
{{--            </h3>--}}
{{--        </div>--}}


{{--    </div>--}}
{{--@endif--}}
{{--@foreach($categories as $key => $category)--}}
{{--    <section id="deal">--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-between">--}}
{{--                <div class="title">--}}
{{--                    <h3>--}}
{{--                        {{$category->title}}--}}
{{--                    </h3>--}}
{{--                </div>--}}
{{--                <a href="{{route('category.products',$category->id)}}" class="btn btn-primary">--}}
{{--                    View more--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="row mt-5">--}}

{{--                <div class="product product-carousel owl-carousel owl-theme">--}}
{{--                    @foreach($category->product as $product)--}}
{{--                        <div class="product-card">--}}
{{--                            <a href="{{route('single.product',$product->id)}}" class="d-block">--}}
{{--                                <div class="product-card-img">--}}
{{--                                    @if(file_exists(public_path('storage/products/'.$product->slug.'/thumbs/small_'.$product->image)))--}}
{{--                                        <figure><img--}}
{{--                                                    src="{{asset('storage/products/'.$product->slug.'/thumbs/small_'.$product->image)}}"--}}
{{--                                                    alt=""></figure>--}}
{{--                                    @else--}}
{{--                                        <figure><img src="{{asset('frontend/images/product-1.png')}}" alt="">--}}
{{--                                        </figure>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="product-card-detail">--}}
{{--                                    <div class="product-name mb-1">--}}
{{--                                        {{$product->title}}--}}
{{--                                    </div>--}}
{{--                                    <div class="product-price d-flex align-items-center justify-content-between">--}}
{{--                                    <span class="product-price-act">--}}
{{--                                        Rs.{{$product->previousPrice}}--}}
{{--                                    </span>--}}
{{--                                        <span class="product-price-dis">--}}
{{--                                       <del> Rs.{{$product->price}} </del>--}}
{{--                                    </span>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@endforeach--}}


<div id="section_best_sellers">

</div>

<section class="mb-3">
    <div class="container">
        <div class="row gutters-10">
            <div class="col-lg-6">
                <div class="section-title-1 clearfix">
                    <h3 class="heading-5 strong-700 mb-0 float-left">
                        <span class="mr-4">{{__('Top 10 Catogories')}}</span>
                    </h3>
                    <ul class="float-right inline-links">
                        <li>
                            <a href="" class="active"
                               style="background: #EB2329; border-color: #EB2329;">{{__('View All Catogories')}}</a>
                        </li>
                    </ul>
                </div>
                <div class="row gutters-5">
                    @foreach (\App\Models\Category::where('top', 1)->get() as $category)
                        <div class="mb-3 col-6">
                            <a href=""
                               class="bg-white border d-block c-base-2 box-2 icon-anim pl-2">
                                <div class="row align-items-center no-gutters">
                                    <div class="col-3 text-center">
                                        <img src="{{ asset('frontend/images/placeholder.jpg') }}"
                                             data-src="{{ asset($category->banner) }}" alt="{{ __($category->name) }}"
                                             class="img-fluid img lazyload">
                                    </div>
                                    <div class="info col-7">
                                        <div class="name text-truncate pl-3 py-4">{{ __($category->name) }}</div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <i class="la la-angle-right c-base-1"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-title-1 clearfix">
                    <h3 class="heading-5 strong-700 mb-0 float-left">
                        <span class="mr-4">{{__('Top 10 Brands')}}</span>
                    </h3>
                    <ul class="float-right inline-links">
                        <li>
                            <a href="" class="active"
                               style="background: #EB2329; border-color: #EB2329;">{{__('View All Brands')}}</a>
                        </li>
                    </ul>
                </div>
                <div class="row gutters-5">
                    @foreach (\App\Models\Brand::where('top', 1)->get() as $brand)
                        <div class="mb-3 col-6">
                            <a href=""
                               class="bg-white border d-block c-base-2 box-2 icon-anim pl-2">
                                <div class="row align-items-center no-gutters">
                                    <div class="col-3 text-center">
                                        <img src="{{ asset('frontend/images/placeholder.jpg') }}"
                                             data-src="{{ asset($brand->logo) }}" alt="{{ __($brand->name) }}"
                                             class="img-fluid img lazyload">
                                    </div>
                                    <div class="info col-7">
                                        <div class="name text-truncate pl-3 py-4">{{ __($brand->name) }}</div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <i class="la la-angle-right c-base-1"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
