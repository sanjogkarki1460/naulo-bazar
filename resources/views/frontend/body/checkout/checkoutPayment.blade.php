@extends('frontend.body.checkout.index')
@section('checkout')
<div class="steps flex-sm-nowrap mb-5"><a class="step " href="{{route('checkout.address')}}">
                        <h4 class="step-title"><i class="fa fa-check-circle check_circle"></i>1. Address</h4></a><a class="step" href="{{route('checkout.shipping')}}">
                        <h4 class="step-title"><i class="fa fa-check-circle check_circle"></i>2. Shipping</h4></a><a class="step active" href="{{route('checkout.payment')}}">
                        <h4 class="step-title">3. Payment</h4></a><a class="step" href="{{route('checkout.review')}}">
                        <h4 class="step-title">4. Review</h4></a>
</div>
<h4>Choose Payment Method</h4>
        <hr class="pb-1">
        <div class="accordion" id="accordion" role="tablist">
            <div class="card">
                <div class="card-header" role="tab">
                    <h6><a href="#card" data-toggle="collapse"><i class="icon-columns"></i>Pay with Credit Card</a></h6>
                </div>
                <div class="collapse show" id="card" data-parent="#accordion" role="tabpanel">
                    <div class="card-body">
                        <p class="text-sm mb-3">We accept following credit cards:
                            &nbsp;<img class="d-inline-block align-middle" src="images/cards.png"
                                       style="width: 187px;" alt="Cerdit Cards"></p>

                        <form class="interactive-credit-card row">
                            <div class="form-group col-sm-6">
                                <input class="form-control" type="text" name="number" placeholder="Card Number" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                            </div>
                            <div class="form-group col-sm-3">
                                <input class="form-control" type="text" name="expiry" placeholder="MM/YY" required>
                            </div>
                            <div class="form-group col-sm-3">
                                <input class="form-control" type="text" name="cvc" placeholder="CVC" required>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-outline-primary btn-block margin-top-none" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab">
                    <h6><a class="collapsed" href="#paypal" data-toggle="collapse"><i class="socicon-paypal"></i>Pay with PayPal</a></h6>
                </div>
                <div class="collapse" id="paypal" data-parent="#accordion" role="tabpanel">
                    <div class="card-body">
                        <p class="text-sm">PayPal - the safer, easier way to pay</p>
                        <form class="row" method="post">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="email" placeholder="E-mail" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-wrap justify-content-between align-items-center"><a class="navi-link text-sm" href="#">Forgot password?</a>
                                    <button class="btn btn-outline-primary margin-top-none" type="submit">Log In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="d-flex justify-content-between pt-4 mt-2">
            <a class="btn btn-outline-secondary m-0" href="checkout-shipping.html">Back</a>
            <a class="btn btn-primary m-0" href="checkout-review.html">Continue</a></div>
@endsection