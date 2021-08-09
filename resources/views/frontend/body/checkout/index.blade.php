@extends('frontend.body.auth.index')
@section('body')
    <div id="checkout">
    <div class="container mb-5">
        <!-- breadcrumb -->
        <section class="breadcrumbs mb-3 ">
    <ul class="d-flex align-items-center">
        <li><a href="#">Home</a></li>
        <li><a href="#">Option</a></li>
        <li><span>Active</span></li>
    </ul>
    </section>
        <div class="row">
            <!-- Checkout Address-->
            <div class="col-sm-9 col-lg-8 mb-3">
               @yield('checkout')
            </div>
            <!-- Sidebar          -->
            <div class="col-sm-3 col-lg-4 mb-3">
                <aside class="sidebar">
                    <div class="padding-top-2x hidden-lg-up"></div>
                    <!-- Order Summary Widget-->
                    <div class="cart-price_container box-shadow">
                        <div class="card-header">
                            <h4>Total Amount</h4>
                        </div>
                        <div class="card-body">
                            @if(Auth::check())
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td>Item Subtotal</td>
                                    <td>Rs.{{number_format($cart->sum('total_price'))}}</td>
                                </tr>
                                <tr>
                                    <td>Shipping Charge</td>
                                    @if($cart->isNotEmpty())
                                        <td>Rs.{{$cart->first()->deliveryCharge($cart)}}</td>
                                    @else
                                        <td>0</td>
                                    @endif
                                </tr>
                                <tr class="border-top mt-3">
                                    <td><strong>Estimate Total </strong><br>
                                        <small>tax calculated in checkout</small>
                                    </td>
                                    @if($cart->isNotEmpty())
                                    <td>
                                      <strong> Rs.{{number_format($cart->sum('total_price')+$cart->first()->deliveryCharge($cart))}}</strong>
                                    </td>
                                    @else
                                    <td><strong>0</strong></td>
                                    @endif  
    
                                </tr>
                            </table>
                            @else
                       
                            <table class="table table-sm table-borderless">
                                <tr>
                                   
                                    <td>Item Subtotal</td>
                                    @if(session()->get('cart'))
                                    <td>Rs.{{session()->get('cart')->totalPrice}}</td>
                                    @else
                                    <td>0</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Shipping Charge</td>
                                    @if(session()->get('cart'))
                                        <td>Rs.{{session()->get('cart')->delivery_charge}}</td>
                                    @else
                                        <td>0</td>
                                    @endif
                                </tr>
                                <tr class="border-top mt-3">
                                    <td><strong>Estimate Total </strong><br>
                                        <small>tax calculated in checkout</small>
                                    </td>
                                    @if(session()->get('cart'))
                                    <td>
                                      <strong> Rs.{{number_format(session()->get('cart')->totalPrice+session()->get('cart')->delivery_charge)}}</strong>
                                    </td>
                                    @else
                                    <td><strong>0</strong></td>
                                    @endif  
    
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>
                    <!-- Featured Products Widget-->

                    <!-- Promo Banner-->

                </aside>
            </div>
        </div>

    </div>
</div>

@endsection