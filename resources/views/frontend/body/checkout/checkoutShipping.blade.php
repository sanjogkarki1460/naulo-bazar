@extends('frontend.body.checkout.index')
@section('checkout')
    <div class="steps flex-sm-nowrap mb-5"><a class="step" href="{{route('checkout.address')}}">
            <h4 class="step-title"><i class="fa fa-check-circle check_circle"></i>1. Address</h4></a><a
                class="step active" href="{{route('checkout.shipping')}}">
            <h4 class="step-title">2. Shipping</h4></a><a class="step" href="{{route('checkout.payment')}}">
            <h4 class="step-title">3. Payment</h4></a><a class="step" href="{{route('checkout.review')}}">
            <h4 class="step-title">4. Review</h4></a>
    </div>

    <h4>Choose Shipping Method</h4>
    <hr class="pb-2">
    <form action="{{route('checkout.create.shipping')}}" method="post">
        @csrf
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-default">
                <tr>
                    <th></th>
                    <th>Shipping method</th>
                    <th>Delivery time</th>
                    <th>Handling fee</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td class="align-middle">
                        <div class="custom-control custom-radio mb-0">
                            <input class="custom-control-input" type="radio" id="courier" value="cashondelivery"
                                   name="shipping_method" checked>
                            <label class="custom-control-label" for="courier"></label>
                        </div>
                    </td>
                    <td class="align-middle"><span class="text-medium">Cash on Delivery</span><br>
                        <span class="text-muted text-sm">@if(Session::has('checkoutaddress')) {{ session()->get('checkoutaddress')['city'] }}
                            , {{ session()->get('checkoutaddress')['address1'] }} @endif</span></td>
                    <td class="align-middle">2 - 4 days</td>
                    @if(Auth::check())

                        <td class="align-middle">
                            Rs.{{number_format($cart->sum('total_price')-$cart->first()->deliveryCharge($cart))}} </td>
                    @else
                        <td class="align-middle">Rs.</td>
                    @endif
                </tr>
                <tr>
                    <td class="align-middle">
                        <div class="custom-control custom-radio mb-0">
                            <input class="custom-control-input" type="radio" value="paypal" id="courier"
                                   name="shipping_method">
                            <label class="custom-control-label" for="courier"></label>
                        </div>
                    </td>
                    <td class="align-middle"><span class="text-medium">Paypal</span><br><span
                                class="text-muted text-sm">
                                @if(Session::has('checkoutaddress')){{ session()->get('checkoutaddress')['city'] }}
                            , {{ session()->get('checkoutaddress')['address1'] }} @endif</span></td>
                    <td class="align-middle">2 - 4 days</td>
                    <td class="align-middle">$22.50</td>
                </tr>
                </tbody>

            </table>
        </div>
        <hr class="pb-2">
        <div class="d-flex justify-content-between"><a class="btn btn-outline-secondary m-0"
                                                       href="{{route('checkout.address')}}">Back</a>
            <button class="btn btn-primary m-0" type="submit">Continue</button>
        </div>
    </form>
    </form>
@endsection