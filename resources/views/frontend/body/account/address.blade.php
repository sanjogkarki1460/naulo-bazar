@extends('frontend.body.account.index')
@section('account')
<div class="col-md-8">

            <div class="mb-5">
                <div class="pt-5 mt-2 hidden-lg-up"></div>
                <h4>Contact Address</h4>
                <hr class="pb-3">
                <form action="{{route('user.updateaddress')}}" class="row" method="post">
                    @csrf
                    @method('put')
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-company">Company</label>
                            <input name="company" class="form-control"  type="text" id="account-company"  value="{{Auth::user()->userAddress->company}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{-- <div class="form-group">
                            <label for="account-country">Country</label>
                            <select name="country" class="form-control" id="account-country">
                                <option>Choose country</option>
                                <option>Australia</option>
                                <option>Canada</option>
                                <option>France</option>
                                <option>Germany</option>
                                <option>Switzerland</option>
                                <option selected>United States</option>
                            </select>
                        </div> --}}
                    </div>
                 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-city">City</label>
                            <select name="city" class="form-control" id="account-city">
                                <option>Choose city</option>
                                @if(Auth::user()->userAddress->city)
                                <option selected>{{ucfirst(Auth::user()->userAddress->city)}}</option>
                                @endif
                                @foreach($deliveries as $key => $value)
                                    <option value="{{ucfirst($value->title)}}">{{ucfirst($value->title)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-zip">ZIP Code</label>
                        <input class="form-control" type="text" name="zip_code" value="{{Auth::user()->userAddress->zip_code}}" id="account-zip" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-address1">Address 1</label>
                            <input class="form-control" name="address1"  value="{{Auth::user()->userAddress->address1}}" type="text" id="account-address1" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-address2">Address 2</label>
                            <input class="form-control" name="address2"  value="{{Auth::user()->userAddress->address2}}" type="text" id="account-address2">
                        </div>
                    </div>
                    <div class="col-12 padding-top-1x">
                        <h4>Shipping Address</h4>
                        <hr class="pb-3">
                        <div class="custom-control custom-checkbox d-block">
                            <input class="custom-control-input" type="checkbox" id="same_address" checked>
                            <label class="custom-control-label" for="same_address">Same as Contact Address</label>
                        </div>
                        <hr class="my-3">
                        <div class="text-right">
                            <button class="btn btn-primary margin-bottom-none" type="submit" data-toast data-toast-position="topRight" data-toast-type="success" data-toast-icon="icon-circle-check" data-toast-title="Success!" data-toast-message="Your address updated successfuly.">Update Address</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection