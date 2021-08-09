@extends('frontend.body.body')
@section('body')
    <div class="login__form">
        <div class="container">
            <div class="cart box-shadow ">
                <div class="card-header d-flex align-items-center">
                    <h4 class="mb-0 mr-3">Track Order</h4>
                </div>
                <div class="card-body cart-box">

                    <div class="form-box-title px-3 py-2">
                        Order Info
                    </div>
                <form action="{{route('user.trackorderstatus')}}" method="post">
                    @csrf
                        <div class="form-group">
                            <input type="text" name="order_id" class="form-control" placeholder="Order Code">
                        </div>
                        <div class="form-group">
                            <button type="submit"  class="btn btn-primary">Track Order</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="cart box-shadow ">
                <div class="card-header d-flex align-items-center">
                    <h4 class="mb-0 mr-3">Order Summary</h4>
                </div>
                <div class="card-body cart-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3"> <b>Product Name</b></div>
                                <div class="col-md-3">Order Status </div>
                                <div class="col-md-3">Quantity </div>
                                <div class="col-md-3">Delivery Address </div>

                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3"> <b>Product Name</b></div>
                                <div class="col-md-3">Order Status </div>
                                <div class="col-md-3">Quantity </div>
                                <div class="col-md-3">Delivery Address </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart box-shadow ">
                <div class="card-header d-flex align-items-center">
                    <ul class="process-steps clearfix">
                        @if(isset($status))
                        <li  @if($status == 'order placed' || $status == 'on the way' || $status == 'delivered' || $status == 'pending') class="active" @endif>
                            <div class="icon">1</div>
                            <div class="title">Order placed</div>
                        </li>
                        <li @if($status == 'on the way' || $status == 'delivered' || $status == 'pending') class="active" @endif>
                            <div class="icon">2</div>
                            <div class="title">On review</div>
                        </li>
                        <li @if($status == 'on the way' || $status == 'delivered') class="active" @endif>
                            <div class="icon">3</div>
                            <div class="title">On delivery</div>
                        </li>
                        <li @if($status == 'delivered') class="active" @endif>
                            <div class="icon">4</div>
                            <div class="title">Delivered</div>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="card-body cart-box">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6"> <b>dasdas</b></div>
                                <div class="col-md-6">dsadsadsad </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6"> <b>dasdas</b></div>
                                <div class="col-md-6">dsadsadsad </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6"> <b>dasdas</b></div>
                                <div class="col-md-6">dsadsadsad </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6"> <b>dasdas</b></div>
                                <div class="col-md-6">dsadsadsad </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection