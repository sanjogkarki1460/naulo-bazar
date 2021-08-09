<header class="header ps-header--dark">
                <div class="ps-top-bar">
                    <div class="container">
                        <div class="top-bar">
                            <div class="top-bar__left">
                                <ul class="nav-top-dark">
                                    <li class="nav-top-item"> <a href="javascript:void(0);"><i class='icon-map-marker'></i>Gokarna, 44600 Kathmandu, Nepal.</a>
                                    </li>
                                    <li class="nav-top-item"> <a href="javascript:void(0);"><i class='icon-telephone'></i> +977-9810099062</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="top-bar__right">
                    <ul class="nav-top">
                        <li class="nav-top-item"><a class="nav-top-link" href="{{route('seller.signup')}}">Sell on Onestore</a></li>
                        <li class="nav-top-item"><a class="nav-top-link" href="{{route('customer.order.track')}}">Order Tracking</a></li>
                        
                        @auth
                        <li  class="nav-top-item account"><a class="nav-top-link" href="javascript:void(0);"> <i class="icon-user"></i>Hi! <span class="font-bold">{{auth()->user()->name}}</span></a>
                            <div class="account--dropdown">
                                <div class="account-anchor">
                                    <div class="triangle"></div>
                                </div>
                                <div class="account__content">
                                    <ul class="account-list">
                                        <li class="title-item">My Account
                                        </li>
                                        <li> <a href="{{route('customer.dashboard')}}">
                                        <i class="icon-menu-circle">&nbsp;</i> Dasdboard</a>
                                        </li>
                                        <li> <a href="{{route('customer.profile')}}">
                                        <i class="icon-users2">&nbsp;</i> My Profile</a>
                                        </li>
                                        <li> <a href="{{route('customer.address')}}">
                                        <i class="icon-map-marker-user">&nbsp;</i> My Address Book</a>
                                        </li>
                                        <li> <a href="{{route('customer.order')}}">
                                            <i class="icon-cart-add">&nbsp;</i> My Orders</a>
                                        </li>
                                        <li> <a href="my_returns.html">
                                        <i class="icon-cart-remove">&nbsp;</i> My Returns</a>
                                        </li>
                                        <li> <a href="my_cancel.html"> <i class="icon-stream-error">&nbsp;</i> My Cancellations</a>
                                        </li>
                                        <li> <a href="{{route('customer.wishlist')}}">
                                        <i class="icon-heart">&nbsp;</i> My Wishlist</a>
                                        </li>
                                        <li> <a href="{{route('customer.review')}}">
                                        <i class="icon-star">&nbsp;</i> My Reviews</a>
                                        </li>
                                        <li> <a href="{{route('customer.change.password')}}">
                                        <i class="icon-eye">&nbsp;</i> Change Password</a>
                                        </li>
                                    </ul>
                                    <a class="account-logout" href="{{route('logout')}}"><i class="icon-exit-left"></i>Log Out</a>
                                </div>
                            </div>
                        </li>
                        @else
                        
                        <li  class="nav-top-item account">
                            <a class="nav-top-link" href="{{route('customer.login')}}"> 
                                <i class="icon-user"></i><span class="font-bold">Login</span></a>
                        </li>
                        <li  class="nav-top-item account">
                            <a class="nav-top-link" href="{{route('customer.signup')}}"> 
                                <i class="icon-user"></i><span class="font-bold">Sign Up</span></a>
                        </li>
                        @endauth
                    </ul>
                </div>
                        </div>
                    </div>
                </div>
                
                <div class="ps-header--center header--mobile">
                    <div class="container">
                        <div class="header-inner">
                            <div class="header-inner__left">
                                <button class="navbar-toggler"><i class="icon-menu"></i></button>
                            </div>
                            <div class="header-inner__center"><a class="logo open" href="{{route('welcome')}}">One<span class="text-black"> Store</span></a></div>
                            <div class="header-inner__right">
                                <button class="button-icon icon-sm search-mobile"><i class="icon-magnifier"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="ps-header--center header-desktop">
                    <div class="container">
                        <div class="header-inner">
                            <div class="header-inner__left"><a class="logo" href="{{route('welcome')}}">One<b class="text-white"> Store</b></a>
                                <button class="category-toggler"><i class="icon-menu"></i></button>
                            </div>
                            <search></search>
                            <cart-notification></cart-notification>
                        </div>
                    </div>
                </section>
                <nav class="navigation">
                    <div class="container">
                    <nav-bar></nav-bar>
                    <ul class="menu">

                            <li class="menu-item-has-children has-mega-menu"><a class="nav-link" href="{{route('store')}}">OneStoreMart</a>
                            </li>
                            <li class="menu-item-has-children has-mega-menu"><a class="nav-link" href="{{route('store')}}">Naulo Bazar</a>
                            </li>
                            <li class="menu-item-has-children has-mega-menu"> <a class="nav-link" href="{{route('flash.product')}}">Flash Sale</a>
                            </li>
                            <li class="menu-item-has-children has-mega-menu menu-item-branch"><a class="nav-link" href="javascript:void(0);">Our Top Venders</a>
                                <span class="sub-toggle"><i class="icon-chevron-down"></i></span>
                                <div class="mega-menu mega-brand">
                                    <div class="mega-anchor"></div>
                                    <div class="brand-box">
                                        <div class="brand__title">FEATURED VENDERS</div>
                                        <div class="row">
                                            <div class="col-4"><a href="index.html"><img src="{{asset('assets/img/brand/brand_themeforest.jpg')}}" alt="alt" /></a></div>
                                            <div class="col-4"><a href="index.html"><img src="{{asset('assets/img/brand/brand_envato.jpg')}}" alt="alt" /></a></div>
                                            <div class="col-4"><a href="index.html"><img src="{{asset('assets/img/brand/brand_codecanyon.jpg')}}" alt="alt" /></a></div>
                                            <div class="col-4"><a href="index.html"><img src="{{asset('assets/img/brand/brand_cudicjungle.jpg')}}" alt="alt" /></a></div>
                                            <div class="col-4"><a href="index.html"><img src="{{asset('assets/img/brand/brand_videohive.jpg')}}" alt="alt" /></a></div>
                                            <div class="col-4"><a href="index.html"><img src="{{asset('assets/img/brand/brand_photodune.jpg')}}" alt="alt" /></a></div>
                                            <div class="col-4"><a href="index.html"><img src="{{asset('assets/img/brand/brand_evatotuts.jpg')}}" alt="alt" /></a></div>
                                            <div class="col-4"><a href="index.html"><img src="{{asset('assets/img/brand/brand_3docean.jpg')}}" alt="alt" /></a></div>
                                            <div class="col-4"><a href="index.html"><img src="{{asset('assets/img/brand/microlancer.jpg')}}" alt="alt" /></a></div>
                                        </div><a class="brand__link" href="{{route('store')}}">See all Venders<i class="icon-chevron-right"></i></a>
                                    </div>
                                    <div class="brand__promotion"><a href="flash-sale.html"><img src="{{asset('assets/img/brand/brand_01.jpg')}}" alt="alt" /></a></div>
                                    <div class="brand__promotion"><a href="flash-sale.html"><img src="{{asset('assets/img/brand/brand_02.jpg')}}" alt="alt" /></a></div>
                                </div>
                            </li>
                        </ul>
                        <div class="navigation-text">
                            <ul class="menu">
                                <li class="menu-item-has-children has-mega-menu"><a class="nav-link" href="{{route('seller.signup')}}">Become A Vendor</a>   
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="mobile-search--slidebar">
                <form action="/search">
                    <div class="mobile-search--content">
                        <div class="mobile-search__header">
                        
                            <div class="mobile-search-box">
                            
                                <div class="input-group">
                                
                                    <input class="form-control" name="keyword" placeholder="I'm shopping for..." id="inputSearchMobile">
                                    <div class="input-group-append">
                                        <button class="btn"> <i class="icon-magnifier"></i></button>
                                    </div>
                               
                                </div>
                                
                                <button type="submit" class="cancel-search"><i class="icon-cross"></i></button>
                               
                            </div>
                        
                          </div>
                    </div>
                    </form>
                </div>
            </header>