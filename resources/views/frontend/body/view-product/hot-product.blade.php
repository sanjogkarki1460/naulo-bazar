@extends('frontend.body.view-product.index')
@section('view-more')
<!-- category page -->
<section id="category-filter" class="category-filter">
    <div class="container-fluid  relative">
        <div class="cat-overlay"></div>
        <div class="d-flex custom--row relative" style="width: 100%">
            <aside class="left--side mb">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header p-0" id="category-list">
                            <h5 class="mb-0">
                                <a class="btn d-block btn-link">
                                    Categories
                                </a>
                            </h5>
                        </div>
                        <div id="collapseOne" >
                           @include('frontend.body.view-product.side-category');
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header p-0" id="brand-list">
                            <h5 class="mb-0">
                                <a class="btn d-block btn-link collapsed">
                                   Brands
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTwo"  style="display: none">
                            @include('frontend.body.view-product.side-brand');
                          
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header p-0" id="Size-list">
                            <h5 class="mb-0">
                                <a class="btn d-block btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Size
                                </a>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="Size-list" data-parent="#accordion">
                            <div class="card-body py-1 size__filter">
                                <form class="scrollbar-3">
                                    <label><input class="uk-checkbox" type="checkbox" checked> Small</label>
                                    <label><input class="uk-checkbox" type="checkbox"> Medium</label>
                                    <label><input class="uk-checkbox" type="checkbox"> Large</label>
                                    <label><input class="uk-checkbox" type="checkbox"> XXL</label>
                                    <label><input class="uk-checkbox" type="checkbox"> XL</label>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="done-filter d-none">
                    <button class="btn view-cart">Done</button>
                </div>
            </aside>
            <div class="  right--side bg-white ">
                <div class="category-banner">
                    <figure><img src="images/banner.png" alt=""></figure>
                </div>
                <div class="pt-5">
                    <section class="breadcrumbs mb-3 ">
            <ul class="d-flex align-items-center">
                <li><a href="#">Home</a></li>
                <li><a href="#">Product</a></li>
                <li><span>Offer</span></li>
            </ul>
        </section>
                </div>
                <div class="Name__of__category my-2 d-flex justify-content-between  align-items-center">
                    <div class="title ">
                        <h3></h3>
                    </div>
                    @include('frontend.body.view-product.sorting')
                    <div class=" my-btn d-none" id="btn-filter">
                        <p>Filter's</p>
                    </div>

                </div>
                <div class="product product-category">
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
                </div>

            </div>

        </div>
    </div>
</section>
@endsection
