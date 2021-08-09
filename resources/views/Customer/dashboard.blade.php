@extends('layout.front')
@section('content')
<main class="no-main">
		<div class="ps-breadcrumb">
			<div class="container">
				<ul class="ps-breadcrumb__list">
					<li class="active"><a href="index.html">Home</a></li>
					<li><a href="javascript:void(0);">User Dashboard</a></li>
				</ul>
			</div>
		</div>

        <section class="section--become">
        
            <h2 class="page__title">My Dashboard</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                        @include('front.partials.dashboardSidebar')
                        </div>
                        <div class="col-12 col-lg-9">
                            <div class="user__content mb-30">
                                <div class="row m-0">
                                    <div class="col-6 col-sm-12 col-md-6 col-lg-4 user__item">
                                        <div class="user__icon"><i class="icon-users2"></i></div>
                                        <div class="user__item__content">
                                            <div class="user_setting_name">My Profile</div>
                                            <p class="user_name">{{auth()->user()->name}}</p>
                                            <a href="{{route('customer.profile')}}" class="btn btn-light btn-sm">
                                                Edit Profile
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-4 user__item">
                                        <div class="user__icon"><i class="icon-map-marker-user"></i></div>
                                        <div class="user__item__content">
                                            <div class="user_setting_name">My Address</div>
                                            <p class="user_name">@if($address){{$address->address}} @else NULL @endif</p>
                                            <a href="{{route('customer.address')}}" class="btn btn-light btn-sm">
                                                Edit Address
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-4 user__item">
                                        <div class="user__icon"><i class="icon-cart-add"></i></div>
                                        <div class="user__item__content">
                                            <div class="user_setting_name">My Order</div>
                                            <p class="user_name">Total Order: <span>{{$myOrderCount}}</span> </p>
                                            <a href="{{route('customer.order')}}" class="btn btn-light btn-sm">
                                                View Order
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-4 user__item">
                                        <div class="user__icon"><i class="icon-cart-remove"></i></div>
                                        <div class="user__item__content">
                                            <div class="user_setting_name">My Returns</div>
                                            <p class="user_name">Order Returns: <span>15</span> </p>
                                            <a href="#" class="btn btn-light btn-sm">
                                                View Returns
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-4 user__item">
                                        <div class="user__icon"><i class="icon-stream-error"></i></div>
                                        <div class="user__item__content">
                                            <div class="user_setting_name">My Cancellations</div>
                                            <p class="user_name">Order Cancel: <span>5</span> </p>
                                            <a href="#" class="btn btn-light btn-sm">
                                                View Cancellations
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-4 vender__item">
                                        <div class="vender__icon"><i class="icon-heart"></i></div>
                                        <div class="user__item__content">
                                            <div class="user_setting_name">My Wishlist</div>
                                            <p class="user_name">Wishlist: <span>{{$wishlistCount}}</span> </p>
                                            <a href="{{route('customer.wishlist')}}" class="btn btn-light btn-sm">
                                                View Wishlist
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($myOrders->count()>0)
                            <div class="product_tbl">
                                <h4>Recent Order</h4>
                                
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order ID #</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($myOrders as $orders)
                                        @foreach($orders->orderDetails as $order)
                                        <tr>
                                            <td>
                                                <div class="order_id">
                                                    {{$orders->code}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="ps-product--vertical"><a href="{{route('product.detail',$order->product->slug)}}"><img class="ps-product__thumbnail" src="{{asset($order->product->thumbnail)}}" alt="alt" /></a>
                                                    <div class="ps-product__content">
                                                        <h5><a class="ps-product__name" href="{{route('product.detail',$order->product->slug)}}">{{$order->product->name}}</a></h5>
                                                        <p class="ps-product__unit">{{$order->product->unit}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="ps-product__price">Rs {{$order->product->selling_price}}</span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-light">Order Detail</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div> 
        </section>
    </main>
@endsection