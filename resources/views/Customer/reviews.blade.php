@extends('layout.front')
@section('content')
<main class="no-main">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="ps-breadcrumb__list">
                    <li class="active"><a href="{{route('welcome')}}">Home</a></li>
                    <li><a href="javascript:void(0);">My Reviews</a></li>
                </ul>
            </div>
        </div>

        <section class="section--become">
            <h2 class="page__title">My Reviews</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                        @include('front.partials.dashboardSidebar')
                        </div>
                        <div class="col-12 col-lg-9">
                            <div class="product_tbl">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sold By</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Review Date</th>
                                            <th scope="col">Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($reviews as $review)
                                        <tr >
                                            <td>
                                               <a href="vendor-store.html">
                                                    {{$review->product->user->name}}
                                               </a>
                                            </td>
                                            <td>
                                                <div class="ps-product--vertical"><a href="{{route('product.detail',$review->product->slug)}}"><img class="ps-product__thumbnail" src="{{$review->product->thumbnail}}" alt="alt" /></a>
                                                    <div class="ps-product__content">
                                                        <h5><a class="ps-product__name" href="product_details.html">{{$review->product->name}}</a></h5>
                                                        <p class="ps-product__unit">{{$review->product->unit}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <small>{{$review->created_date}}</small>
                                            </td>
                                            <td>
                                            <star-rating :increment="0.2" :star-size="15" :read-only="true"  :rating="{{$review->rating}}"></star-rating>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td>No reviews yet</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div> 
        </section>
    </main>
@endsection