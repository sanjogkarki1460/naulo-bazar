@extends('layout.front')
@section('content')
<main class="no-main">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="ps-breadcrumb__list">
                <li class="active"><a href="{{route('welcome')}}">Home</a></li>
                <li><a href="javascript:void(0);">User Login</a></li>
            </ul>
        </div>
    </div>

<section class="section--login">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="login__box">
                    <div class="login__header">
                        <h3 class="login__login">Welcome to OneStore! Please login.</h3>
                    </div>
                    <div class="login__content">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{route('customer.authenticate')}}">
                        @csrf
                        
                        <div class="form-row">
                        
                            <div class="col-12 col-lg-12 form-group--block">
                                <label>Phone Number or Email: </label>
                                <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Phone Or Email" required="">
                            </div>
                            <div class="col-12 col-lg-12 form-group--block">
                                <label>Password: </label>
                                <div class="input-group group-password">
                                    <input class="form-control" name="password" type="password">
                                    <div class="input-group-append">
                                        <button class="btn forgot-pass" type="button" onclick="window.location.href='user_forgot_pw.html'">Forgot?</button>
                                    </div>
                                </div>  
                            </div>
                            
                            <div class="col-12 col-lg-12  form-group--block">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" value="true" checked  id="rem0">
                                    <label for="rem0">Remember Me</label>
                                </div>
                            </div>
                        </div>
                         <button class="btn btn-login" type="submit">Login</button>
                        <div class="login__conect">
                            <hr>
                            <p>Or Login with</p>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <button class="btn btn-social btn-facebook" type="button"> <i class="fa fa-facebook-f"></i>Facebook</button></div>
                            <div class="col-12 col-lg-6">
                                <button class="btn btn-social btn-google" type="button"> <i class="fa fa-google-plus"></i>Google</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="login_big_link">
                <h3 class="login__title">New Member?</h3>
                <h3>
                    <a href="{{route('customer.signup')}}"><i class="fa fa-hand-o-right"></i> Register Here.</a>
                </h3>
            </div>

            <h3 class="login__title">Advantages Of Becoming A Member</h3>
            <p class="login__description"> <b>OneStore Buyer Protection </b>has you covered from click to delivery.<br>Sign up or sign in and you will be able to: </p>
            <div class="login__orther">
                <p> <i class="icon-truck"></i>Easily Track Orders, Hassle free Returns</p>
                <p> <i class="icon-alarm2"></i>Get Relevant Alerts and Recommendation</p>
                <p><i class="icon-star"></i>Wishlist, Reviews, Ratings and more.</p>
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