@extends('backend.body')
@section('body')


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Dashboard </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>




    <!-- dashboard content -->
        <div class="row clearfix">
            <div class="col-md-3">
                <div class="card">
                    <div class="body">
                        <div>{{__('Products')}}</div>
                        <div class="py-4 m-0 text-center h1 text-success">{{ count(\App\Product::where('user_id', Auth::user()->id)->get()) }}</div>

                    </div>
                </div>
            </div>



            <div class="col-md-3 ">
                <div class="card">
                    <div class="body">
                        <div>{{__('Total sale')}}</div>
                        <div class="py-4 m-0 text-center h1 text-success">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}</div>

                    </div>
                </div>
            </div>



            <div class="col-md-3">
                <div class="card">
                    <div class="body">
                        <div>{{__('Total earnings')}}</div>
                        @php
                        $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->get();
                        $total = 0;
                        foreach ($orderDetails as $key => $orderDetail) {
                            if($orderDetail->order->payment_status == 'paid'){
                                $total += $orderDetail->price;
                            }
                        }
                    @endphp
                        <div class="py-4 m-0 text-center h1 text-success">{{ single_price($total) }}</div>
                        <div class="d-flex">

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 ">
                <div class="card">
                    <div class="body">
                        <div>{{__('Successful orders')}}</div>
                        <div class="py-4 m-0 text-center h1 text-success">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}</div>

                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-box bg-black mt-4">
                    <div class="card-header px-3 py-2 text-center">
                        <strong>{{__('Orders')}}</strong>
                    </div>
                    <div class="form-box-content p-3">
                        <table class="table mb-0 table-bordered" style="font-size:14px;">
                            <tr>
                                <td>{{__('Total orders')}}:</td>
                                <td><strong class="heading-6">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->get()) }}</strong></td>
                            </tr>
                            <tr >
                                <td>{{__('Pending orders')}}:</td>
                                <td><strong class="heading-6">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'pending')->get()) }}</strong></td>
                            </tr>
                            <tr >
                                <td>{{__('Cancelled orders')}}:</td>
                                <td><strong class="heading-6">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'cancelled')->get()) }}</strong></td>
                            </tr>
                            <tr >
                                <td>{{__('Successful orders')}}:</td>
                                <td><strong class="heading-6">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                {{-- <div class="bg-white mt-4 p-5 text-center">
                    <div class="mb-3">
                        @if(Auth::user()->seller->verification_status == 0)
                            <img loading="lazy"  src="{{ asset('frontend/images/icons/non_verified.png') }}" alt="" width="130">
                        @else
                            <img loading="lazy"  src="{{ asset('frontend/images/icons/verified.png') }}" alt="" width="130">
                        @endif
                    </div>
                    @if(Auth::user()->seller->verification_status == 0)
                        <a href="{{ route('shop.verify') }}" class="btn btn-styled btn-base-1">{{__('Verify Now')}}</a>
                    @endif
                </div> --}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-box bg-white mt-4">
                    <div class="card-header px-3 py-2 text-center text">
                        {{__('Products')}}
                    </div>
                    <div class="form-box-content p-3 category-widget">
                        <ul class="clearfix">
                            @foreach (\App\Category::all() as $key => $category)
                                @if(count($category->products->where('user_id', Auth::user()->id))>0)
                                    <li><a>{{ __($category->name) }}<span>({{ count($category->products->where('user_id', Auth::user()->id)) }})</span></a></li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="text-center">
                            <a href="{{ route('products.seller')}}" class="btn p-3 badge badge-primary">{{__('Add New Product')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)
                    <div class="form-box bg-white mt-4">
                        <div class="form-box-title px-3 py-2 clearfix ">
                            {{__('Purchased Package')}}
                        </div>
                        @php
                            $seller_package = \App\SellerPackage::find(Auth::user()->seller->seller_package_id);
                        @endphp
                        <div class="form-box-content p-3">
                            @if($seller_package != null)
                                <div class="form-box-content p-2 category-widget text-center">
                                    <center><img alt="Package Logo" src="{{ asset($seller_package->logo) }}" style="height:100px; width:90px;"></center>
                                    <br>
                                    <strong><p>{{__('Product Upload Remaining')}}: {{ Auth::user()->seller->remaining_uploads }} {{__('Times')}}</p></strong>
                                    <strong><p>{{__('Digital Product Upload Remaining')}}: {{ Auth::user()->seller->remaining_digital_uploads }} {{__('Times')}}</p></strong>
                                    <strong><p>{{__('Package Expires at')}}: {{ Auth::user()->seller->invalid_at }}</p></strong>
                                    <strong><p><div class="name mb-0">{{__('Current Package')}}: {{ $seller_package->name }} <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span></div>

                            @else
                                <div class="form-box-content p-2 category-widget text-center">
                                    <center><strong><p>{{__('Package Not Found')}}</p></strong></center>
                                </div>
                            @endif
                            <div class="text-center">
                                <a href="{{ route('seller_packages_list') }}" class="btn btn-styled btn-base-1 btn-outline btn-sm">{{__('Upgrade Package')}}</a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="bg-white mt-4 p-4 text-center font-black">
                    <div class="card-header strong-700">{{__('Shop')}}</div>
                    <p>{{__('Manage & organize your shop')}}</p>
                    <a href="{{ route('shops.index') }}" class="badge badge-primary font-12 p-3">{{__('Go to setting')}}</a>
                </div>

            </div>
        </div>
    </div>



@endsection
