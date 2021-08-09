@extends('layout.front')
@section('content')
<main class="no-main">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="ps-breadcrumb__list">
                <li class="active"><a href="{{route('welcome')}}">Home</a></li>
                <li class="active"><a href="{{route('store')}}">Store List</a></li>
                <li><a href="javascript:void(0);">Sangita Ymart</a></li>
            </ul>
        </div>
    </div>

    <section class="section--vendorStore">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="contact__vendor">
                        <h5 class="widget__title">CONTACT VENDOR</h5>
                        <form>
                            <div class="form-row">
                                <div class="col-12 form-group--block">
                                    <input class="form-control" type="text" placeholder="Your Name">
                                </div>
                                <div class="col-12 form-group--block">
                                    <input class="form-control" type="text" placeholder="you@example.com">
                                </div>
                                <div class="col-12 form-group--block">
                                    <textarea class="form-control" placeholder="Type your message..."></textarea>
                                </div>
                                <div class="col-12 form-group--block">
                                    <button class="btn ps-button">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="store__header">
                        <div class="row m-0">
                            <div class="col-12 col-lg-4 p-0">
                                <div class="store__avatar">
                                    @if($user->shop)
                                    <img src="{{$user->shop->shop_logo}}" alt>
                                    @else
                                    <img src="{{$user->user_avatar}}" alt>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-lg-8 p-0">
                                <div class="store__detail">
                                    <h3 class="store__name">{{$user->name}}</h3>
                                    <p class="store__address">{{$user->address}}, {{$user->city}}, {{$user->country}}</p>
                                    <p class="store__phone">(+977) {{$user->phone}} </p>
                                    <p class="store__email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="7b081a16080e151c241c1a0f131e093b1c161a121755181416">{{$user->email}}</a></p>
                                    <div class="store__rating">
                                        
                                    </div>
                                    <div class="store__social">
                                    @if($user->shop)
                                    <div class="store__social" >
                                        @if($user->shop->facebook)
                                        <a class="icon_social facebook" href="{{$user->shop->facebook}}"><i class="fa fa-facebook-f"></i></a>
                                        @endif
                                        @if($user->shop->twitter)
                                        <a class="icon_social twitter" href="{{$user->shop->twitter}}"><i class="fa fa-twitter"></i></a>
                                        @endif
                                        @if($user->shop->google)
                                        <a class="icon_social google" href="{{$user->shop->google}}"><i class="fa fa-google-plus"></i></a>
                                        @endif
                                        @if($user->shop->youtube)
                                        <a class="icon_social youtube" href="{{$user->shop->youtube}}"><i class="fa fa-youtube"></i></a>
                                        @endif
                                        <a class="icon_social wifi" href="#"><i class="fa fa-wifi"></i></a>
                                    </div>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <seller-product :user="{{$user}}"></seller-product>
                </div>

            </div>
        </div>
    </section>
</main>
@endsection