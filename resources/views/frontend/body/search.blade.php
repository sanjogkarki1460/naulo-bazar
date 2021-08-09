@extends('frontend.body.view-product.index')
@section('view-more')
    <!-- category page -->
    <section id="category-filter" class="category-filter">
        <div class="container-fluid  relative">
            <div class="cat-overlay"></div>
            <div class="d-flex custom--row relative" style="width: 100%">
                <aside class="left--side mb">
                    <div id="accordion">
                        @if(isset($otherCategories))
                            <div class="card">
                                <div class="card-header p-0" id="category-list">
                                    <h5 class="mb-0">
                                        <a class="btn d-block btn-link">
                                            Similar Categories
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapseOne">
                                    @include('frontend.body.view-product.side-category');
                                </div>

                            </div>
                        @endif
                        @if(isset($brands))
                            <div class="card">
                                <div class="card-header p-0" id="brand-list">
                                    <h5 class="mb-0">
                                        <a class="btn d-block btn-link collapsed">
                                            Brands
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTwo" style="display: none">
                                    @include('frontend.body.view-product.side-brand');

                                </div>
                            </div>
                        @endif
                        {{--                        <div class="card">--}}
                        {{--                            <div class="card-header p-0" id="Size-list">--}}
                        {{--                                <h5 class="mb-0">--}}
                        {{--                                    <a class="btn d-block btn-link collapsed" data-toggle="collapse"--}}
                        {{--                                       data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">--}}
                        {{--                                        Size--}}
                        {{--                                    </a>--}}
                        {{--                                </h5>--}}
                        {{--                            </div>--}}
                        {{--                            <div id="collapseThree" class="collapse" aria-labelledby="Size-list"--}}
                        {{--                                 data-parent="#accordion">--}}
                        {{--                                <div class="card-body py-1 size__filter">--}}
                        {{--                                    <form class="scrollbar-3">--}}
                        {{--                                        <label><input class="uk-checkbox" type="checkbox" checked> Small</label>--}}
                        {{--                                        <label><input class="uk-checkbox" type="checkbox"> Medium</label>--}}
                        {{--                                        <label><input class="uk-checkbox" type="checkbox"> Large</label>--}}
                        {{--                                        <label><input class="uk-checkbox" type="checkbox"> XXL</label>--}}
                        {{--                                        <label><input class="uk-checkbox" type="checkbox"> XL</label>--}}
                        {{--                                    </form>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="done-filter d-none">
                        <button class="btn btn-outline-dark view-cart">Done</button>
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
                                <li><span>Search</span></li>
                            </ul>
                        </section>
                    </div>
                    <div class="Name__of__category my-2 d-flex justify-content-between  align-items-center">
                        <div class="title ">
                            <h3>You search for {{$title}} </h3>
                        </div>
                        @include('frontend.body.view-product.sorting')
                        <div class=" my-btn d-none" id="btn-filter">
                            <p>Filter's</p>
                        </div>

                    </div>
                    @if(count($products) > 0)
                        <div class="product product-category" id="product-data">
                            {{-- @include('frontend.body.view-product.product-data')
                             --}}
                            @foreach($products as $key => $value)
                                <div class="product-card">
                                    <a href="{{route('single.product',$value->id)}}" class="d-block">
                                        <div class="product-card-img">
                                            @if(file_exists(public_path('storage/products/'.$value->slug.'/thumbs/small_'.$value->image)))
                                                <figure><img
                                                            src="{{asset('storage/products/'.$value->slug.'/thumbs/small_'.$value->image)}}"
                                                            alt=""></figure>
                                            @else
                                                <figure><img src="{{asset('frontend/images/product-1.png')}}" alt="">
                                                </figure>
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
                        <div class="product product-category" id="result-data">

                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger text-center">No Products Found!!</div>
                            </div>
                        </div>
                    @endif
                    @if(!isset($title))
                        <section id="pagination">
                            <nav aria-label="pagination">
                                <ul class="pagination">
                                    {!! $products->render() !!}
                                </ul>
                            </nav>
                        </section>
                    @else
                        <section id="pagination">
                            <nav aria-label="pagination">
                                <ul class="pagination">
                                    {{$products->appends(Request::only('search'))->links()}}
                                </ul>
                            </nav>
                        </section>
                    @endif
                </div>

            </div>
        </div>
    </section>
@endsection