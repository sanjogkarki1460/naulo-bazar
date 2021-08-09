@extends('layout.front')
@section('content')
<main class="no-main">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="ps-breadcrumb__list">
                <li class="active"><a href="{{route('welcome')}}">Home</a></li>
                <li><a href="javascript:void(0);">Store List</a></li>
            </ul>
        </div>
    </div>


<section class="section--storeList">
    <div class="container">
        <h2 class="page__title">Store List</h2>
        <div class="storeList__search row">
            <div class="col-12 col-lg-4">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for vendor...">
                    <div class="input-group-append"><i class="icon-magnifier"></i></div>
                </div>
            </div>
        </div>
        <div class="storeList__content">
            <div class="row">
                @forelse($stores as $store)
                <div class="col-12 col-lg-4">
                    <div class="storeList__item">
                        <div class="item__header"><img src="assets/img/store_list_1.jpg" alt="alt" />
                            <div class="item__content">
                               @if($store->shop)
                                    @if($store->shop->name)
                                    <h5 class="item__title"> {{$store->shop->name}} </h5>
                                    @else
                                    <h5 class="item__title"> {{$store->name}} </h5>
                                    @endif
                                    <div class="item__street">{{$store->shop->address}}</div>
                                    <div class="item__address">44600, Kathmandu, Nepal</div>
                                    <div class="item__phone"> <i class="fa fa-phone"></i>(+977) {{$store->phone}}</div>
                                @else
                                    <h5 class="item__title"> {{$store->name}} </h5>
                                    <div class="item__street">{{$store->address}}, {{$store->postal_code}} </div>
                                    <div class="item__address">{{$store->postal_code}}, {{$store->city}}, {{$store->country}}</div>
                                    <div class="item__phone"> <i class="fa fa-phone"></i>(+977) {{$store->phone}}</div>
                                @endif
                                
                            </div>
                        </div>
                        <div class="item__footer"><a class="item__store" href="{{route('vendor.detail',$store->id)}}">Visit Store</a>
                            <div class="item__avatar">
                            @if($store->shop)
                                <div class="avatar"><img src="{{$store->shop->shop_logo}}" alt="alt" /></div>
                            @else
                            <div class="avatar"><img src="{{$store->user_avatar}}" alt="alt" /></div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</section>


</main>
@endsection