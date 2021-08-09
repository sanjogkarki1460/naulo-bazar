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

    <div class="card text-center border-primary">
    <div class="card-body pt-2">
        <h3 class="card-title mb-4">Thank you for your order!</h3>
        <p class="text-sm mb-2">Your order has been placed and will be processed as soon as possible.</p>
        <p class="text-sm mb-2">Make sure you make note of your order number, which is <span class="text-medium">34VB5540K83</span></p>
        <p class="text-sm mb-2">You will be receiving an email shortly with confirmation of your order.
            <u>You can now:</u>
        </p>
    <div class="py-1"><a class="btn btn-outline-secondary" href="{{route('home')}}">Go Back Shopping</a><a class="btn btn-outline-primary" href="order-tracking.html"><i class="material-icons my_location"></i>&nbsp;Track order</a></div>
    </div>
</div>

 </div>
</div>
@endsection