@extends('layout.front')
@section('content')
<main class="no-main">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="ps-breadcrumb__list">
                <li class="active"><a href="{{route('welcome')}}">Home</a></li>
                <li><a href="javascript:void(0);">User Register</a></li>
            </ul>
        </div>
    </div>

<section class="section--login">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="login__box">
                    <div class="login__header">
                        <h3 class="login__login">Create your OneStore Account</h3>
                    </div>
                    <div class="login__content">
                    <sign-up></sign-up>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="login_big_link">
                <h3 class="login__title">Already Have an Account?</h3>
                <h3>
                    <a href="{{route('customer.login')}}"><i class="fa fa-hand-o-right"></i> Login Here.</a>
                </h3>
            </div>

            <h3 class="login__title">Advantages Of Becoming A Member</h3>
            <p class="login__description"> <b>OneStore Buyer Protection </b>has you covered from click to delivery.<br>Sign up or sign in and you will be able to: </p>
            <div class="login__orther">
                <p> <i class="icon-truck"></i>Easily Track Orders, Hassle free Returns</p>
                <p> <i class="icon-alarm2"></i>Get Relevant Alerts and Recommendation</p>
                <p><i class="icon-star"></i>Wishlist, Reviews, Ratings and more.</p>
            </div>
            <div class="login__vourcher">
                <div class="vourcher-money"><span class="unit">Rs</span><span class="number">25</span></div>
                <div class="vourcher-content">
                    <h4 class="vourcher-title">GIFT VOURCHER FOR FISRT PURCHASE</h4>
                    <p>We give Rs25 as a small gift for your first purchase.<br>Welcome to OneStore Market!</p>
                </div>
            </div>

            <div class="help-area">
                <h3> Need Help? </h3>
                <p>
                  If you are facing any problem and have any query then feel free to ask.
                </p>
                <h4 class="phone-number">
                  <i class="icon-phone">&nbsp;</i>
                  +977-9810099062
                </h4>
                <h4 class="email-address">
                  <i class="icon-envelope">&nbsp;</i>
                   support@onestorenepal.com.np
                </h4>
                <div class="clearfix"></div>
            </div>

        </div>
    </div>
  </div>
</section>


</main>
@endsection