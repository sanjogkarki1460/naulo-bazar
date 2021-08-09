@extends('frontend.body.checkout.index')
@section('checkout')
<div class="steps flex-sm-nowrap mb-5"><a class="step active" href="{{route('checkout.address')}}">
                        <h4 class="step-title">1. Address</h4></a><a class="step" href="{{route('checkout.shipping')}}">
                        <h4 class="step-title">2. Shipping</h4></a><a class="step" href="{{route('checkout.payment')}}">
                        <h4 class="step-title">3. Payment</h4></a><a class="step" href="{{route('checkout.review')}}">
                        <h4 class="step-title">4. Review</h4></a>
</div>
 <h4>Billing Address</h4>

            <hr class="pb-2">
    <form action="{{route('checkout.create.address')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-fn">First Name</label>
                        <input class="form-control" name="name" type="text" value="{{Auth::check() ? Auth::user()->name : null}}" id="checkout-fn">
                        </div>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-email">E-mail Address</label>
                            <input class="form-control" name="email" value="{{Auth::check() ? Auth::user()->email : null}}" type="email" id="checkout-email">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-phone">Phone Number</label>
                            <input class="form-control" name="phone_number"  value="{{Auth::check() ? Auth::user()->phonenumber : null}}" type="text" id="checkout-phone">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-company">Company</label>
                        <input class="form-control" name="company" value="{{$useraddress ? $useraddress->company : null}}" type="text" id="checkout-company">
                        </div>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-city">City</label>
                            <select name="city" class="form-control" id="checkout-city">
                                <option value="{{$useraddress ? $useraddress->city : null}}">{{$useraddress ? $useraddress->city : "Choose city"}}</option>
                                @foreach($deliveries as $key => $value)
                                    <option value="{{$value->title}}">{{$value->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-zip">ZIP Code</label>
                            <input name="zip_code" value="{{$useraddress ? $useraddress->zip_code : null}}" class="form-control" type="text" id="checkout-zip">
                        </div>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-address1">Address 1</label>
                            <input name="address1"  value="{{$useraddress ? $useraddress->address1 : null}}" class="form-control" type="text" id="checkout-address1">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="checkout-address2">Address 2</label>
                            <input name="address2" class="form-control" type="text"  value="{{$useraddress ? $useraddress->address2 : null}}" id="checkout-address2">
                        </div>
                    </div>
                </div>
                @if(Auth::check())
                <h4>Shipping Address</h4>
                <hr class="pb-2">
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="same_address" @if(Auth::check()) checked @endif>
                        <label class="custom-control-label" for="same_address">Same as billing address</label>
                    </div>
                </div>
                @endif
                <hr class="pb-2">
                <div class="d-flex justify-content-between"><a class="btn btn-outline-secondary m-0" href="{{route('cart')}}">Back To Cart</a>
                <button class="btn btn-primary m-0" type="submit">Continue</button></div>
            </form>
@endsection
@if(Auth::check())
@push('scripts')
<script>
     $(document).ready(function(){
         var fullname = $('#checkout-fn').val();
         console.log(fullname);
         var email = $("#checkout-email").val() ;
         var phone_number=$("#checkout-phone").val();
         var company = $("#checkout-company").val() ;
         var city = $("#checkout-city").val() ;
         var zip_code = $("#checkout-zip").val() ;
         var address1 = $("#checkout-address1").val() ;
         var address2 = $("#checkout-address2").val() ;

        $('input[type="checkbox"]').click(function(){
            if($(this).is(":checked")){
                $('#checkout-fn').val(fullname)
                $("#checkout-email").val(email) ;
                $("#checkout-phone").val(phone_number);
                $("#checkout-company").val(company) ;
                $("#checkout-city").val(city) ;
                $("#checkout-zip").val(zip_code) ;
                $("#checkout-address1").val(address1) ;
                $("#checkout-address2").val(address2) ;
            }
            else if($(this).is(":not(:checked)")){
                $('#checkout-fn').val('')
                $("#checkout-email").val('') ;
                $("#checkout-phone").val('');
                $("#checkout-company").val('') ;
                $("#checkout-city").val('') ;
                $("#checkout-zip").val('') ;
                $("#checkout-address1").val('') ;
                $("#checkout-address2").val('') ;
            }
        });
    });
</script>
@endpush
@endif