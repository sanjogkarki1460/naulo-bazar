<header class="header">
    <div class="top-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <ul class="d-flex justify-content-sm-between justify-content-end py-md-2 py-sm-1">
                        <li><a href="" class="d-inline-block">Sell us </a></li>
                        <li><a href="" class="d-inline-block">Customer Care</a></li>
                        <li><a href="" class="d-inline-block">Track Order</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-added">
    <div class="container">
        <div class="main-header py-md-3 py-1">
            <nav>
                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-4 col-12">
                        <div class="d-flex align-items-center justify-content-between">

                         <div class="d-flex align-items-center">
                             <div class="d-block d-sm-none mr-3">
                                 <a href="javascript:void(0)" class="navbar-toggler " type="button" id="navToggle">
                                     <span class=" text-muted">
                                          <i class="fas fa-bars"></i>
                                     </span>
                                 </a>
                            </div>
                            <div class="company-logo">
                                <a href="{{route('home')}}">
                                    <figure><img src="{{ asset('backend/assets/images/zholaa_logo.png') }}" alt=""></figure>
                                </a>
                            </div>
                         </div>
                            <div class="d-block d-sm-none">
                                <ul class="d-flex user justify-content-around align-items-center">
                                    <li class="user-log relative"><a href="{{route('login')}}" class="d-inline-block py-2">
                                            <figure><img src="{{asset('frontend/images/identity.png')}}" alt=""></figure>
                                        </a>
                                        <ul class="user-log-opt">
                                            <li><a href="">Account</a></li>
                                            <li><a href="">Wishlist</a></li>
                                            <li><a href="">Order</a></li>
                                            <li><a href="">Logout</a></li>
                                        </ul>
                                    </li>
                                    <li class="user-cart"><a href="javascript:void(0)" id="cartToggle" class="d-inline-block py-2">
                                            <figure><img src="{{asset('frontend/images/shopping_cart.png')}}" alt=""></figure>
                                        </a>
                                        <ul class="user-cart-opt">
                                            <li></li>
                                        </ul>
                                    </li>
                                    <li class="user-search">
                                        <a href="javascript:void(0)" class="d-inline-block text-muted search-icon">
                                            <i class="fas fa-search"></i>
                                        </a>
                                        <input type="text" class="mob-search-box" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 d-sm-block d-none">
                        <div class="search-box d-flex ">
                            <input type="text" class="search" name="search">
                            <button class="btn-search"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-2 d-sm-block d-none">
                        <ul class="d-flex user justify-content-around">
                            <li class="user-log relative"><a href="" class="d-inline-block py-2">
                                    <figure><img src="{{asset('frontend/images/identity.png')}}" alt=""></figure>
                                </a>
                                <ul class="user-log-opt">
                                        
                                </ul>
                            </li>
                            <li class="user-cart"><a href="javascript:void(0)" id="cartToggle" class="d-inline-block py-2">
                                    <figure><img src="{{asset('frontend/images/shopping_cart.png')}}" alt=""></figure>
                                </a>
                                <ul class="user-cart-opt">
                                    <li></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="bottom-header">
        <div class="container">
            <div class="row align-items-center">
                @include('frontend.body.category.category')
                <div class="col-md-7 col-sm-6">
                    <ul class="d-flex justify-content-md-end  justify-content-center my-md-2 my-sm-0 py-sm-0 py-2">
                        <li><a href="index.html" class="d-inline-block btn btn-primary  mx-2">Shop</a></li>
                        <li><a href="service.html" class="d-inline-block btn btn-primary  mx-2">Cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    


<!-- The whole page content goes here -->
<div class="cat-overlay" style="display: none;"></div>

<div class="navbar-collapse offcanvas-collapse">
    <button class="close-collapse btn btn-danger btn-sm  float-right">X</button>
    <div class="clearfix"></div>
    <section class="mobile-nav" >

        <ul class="metismenu" id="menu">
            <li >
                <a  href="index.html" aria-expanded="true">Home</a>
            </li>
            <li>
                <a  href="category-page.html" aria-expanded="false">Electronics<span class="fa arrow"></span></a>
                <ul aria-expanded="false" class="list-levels">
                    <li><a href="">Item 1</a></li>
                    <li><a href="">Item 2</a></li>
                    <li><a href="">Item 3</a></li>
                    <li><a href="">Item 4</a></li>
                    <li><a href="">Item 5</a></li>
                </ul>
            </li>
            <li>
                <a  href="category-page.html" aria-expanded="false">
                    Home Appliance<span class="fa arrow"></span>
                </a>
                <ul aria-expanded="false" class="list-levels">
                    <li><a href="">kitchen<span class="fa plus-times"></span></a>
                        <ul aria-expanded="false" class="list-levels">
                            <li><a href="?">item 1.3.1</a></li>
                            <li><a href="?">item 1.3.2</a></li>
                            <li><a href="?">item 1.3.3</a></li>
                            <li><a href="?">item 1.3.4</a></li>
                        </ul></li>
                    <li>
                        <a href="?" aria-expanded="false">bed room<span class="fa plus-times"></span></a>
                        <ul aria-expanded="false" class="list-levels">
                            <li><a href="?">item 2.3.1</a></li>
                            <li><a href="?">item 2.3.2</a></li>
                            <li><a href="?">item 2.3.3</a></li>
                            <li><a href="?">item 2.3.4</a></li>
                        </ul>
                    </li>
                    <li><a href="">terrance<span class="fa plus-times"></span></a>
                        <ul aria-expanded="false" class="list-levels">
                            <li><a href="?">item 1.3.1</a></li>
                            <li><a href="?">item 1.3.2</a></li>
                            <li><a href="?">item 1.3.3</a></li>
                            <li><a href="?">item 1.3.4</a></li>
                        </ul></li>
                    <li>
                        <a href="?" aria-expanded="false">Item 3<span class="fa plus-times"></span></a>
                        <ul aria-expanded="false" class="list-levels">
                            <li><a href="?">item 2.3.1</a></li>
                            <li><a href="?">item 2.3.2</a></li>
                            <li><a href="?">item 2.3.3</a></li>
                            <li><a href="?">item 2.3.4</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a  href="aboutpage.html" aria-expanded="false">About us</a>
            </li>
            <li>
                <a  href="contactpage.html" aria-expanded="false">Contact us</a>
            </li>
        </ul>
    </section>

</div>

@include('frontend.body.cart.side-cart')
@include('frontend.body.comparision.side-comparision')
</header>
