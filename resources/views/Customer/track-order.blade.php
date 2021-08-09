@extends('layout.front')
@section('content')
<main class="no-main">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="ps-breadcrumb__list">
                <li class="active"><a href="index.html">Home</a></li>
                <li class="active"><a href="shop.html">Shop</a></li>
                <li><a href="javascript:void(0);">Order Tracking</a></li>
            </ul>
        </div>
    </div>

<section class="section--order-tracking">
    <div class="container">
        <h2 class="page__title">Order Tracking</h2>
        <div class="order-tracking__content">
            <div class="order-tracking__form">
                <form>
                    <div class="form-row">
                        <div class="col-12">
                            <p>To track your order please anter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                        </div>
                        <div class="col-12 form-group--block">
                            <label>Order Id: </label>
                            <input class="form-control" type="text" placeholder="Found in your order confirmation email">
                        </div>
                        <div class="col-12 form-group--block">
                            <label>Billing Email: </label>
                            <input class="form-control" type="text" placeholder="Email you used during checkout">
                        </div>
                        <div class="col-12 form-group--block">
                            <button class="btn ps-button">Tracking</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


</main>
@endsection