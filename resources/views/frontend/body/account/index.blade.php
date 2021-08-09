@extends('frontend.body.body')
@section('body')


    <!-- contact us section -->
    <div class="container">
        <section class="breadcrumbs mb-3 ">
            <ul class="d-flex align-items-center">
                <li><a href="#">Home</a></li>
                <li><a href="#">Option</a></li>
                <li><span>User</span></li>
            </ul>
        </section>
        <div class="row">
        @if(Auth::check())
            <div class="col-md-4">
                <aside class="user-info-wrapper">
                    <div class="user-cover" style="background-image: url({{asset('frontend/images/account/user-cover-img.jpg')}});">
                        <div class="info-label" data-toggle="tooltip"
                            title="You currently have 622 Reward Points to spend">
                            <i class="material-icons redeem"></i>622 points
                        </div>
                    </div>
                    <div class="user-info">
                        <div class="user-avatar"><a class="edit-avatar" href="#"><i
                                    class="material-icons edit"></i>Edit</a><img src="{{asset('frontend/images/account/user-ava.jpg')}}"
                                alt="User"></div>
                        <div class="user-data">
                            <h5>{{Auth::user()->name}}</h5><span>Joined {{Auth::user()->created_at->format('Y-m-d')}}</span>
                        </div>
                    </div>
                    <nav class="list-group">

                        <a class="list-group-item @if(Request::is('account/profile')) active @endif " href="{{route('profile')}}">
                            Profile</a>
                        <a class="list-group-item @if(Request::is('account/address')) active @endif " href="{{route('address')}}">
                            Addresses</a>
                        <a class="list-group-item with-badge @if(Request::is('account/wishlist')) active @endif" href="{{route('wishlist')}}">
                            Wishlist<span class="badge badge-primary  float-right badge-pill">3</span></a>
                        <a class="list-group-item with-badge @if(Request::is('account/order')) active @endif" href="{{route('order')}}">
                            Orders<span class="badge badge-primary  float-right badge-pill">6</span>
                        </a>
                    
                    </nav>
                </aside>
            </div>
            @endif
            @yield('account')
        </div>
    </div>
 
    
@endsection