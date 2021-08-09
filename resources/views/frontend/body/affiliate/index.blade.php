@extends('frontend.body.body')
@section('body')
 <div class="login__form">
        <div class="container">
            <div class="cart box-shadow ">
                <div class="card-header d-flex align-items-center">
                    <h4 class="mb-0 mr-3">Affiliate Information</h4>
                </div>
                <div class="card-body cart-box">
                    
                    <div class="form-box-title px-3 py-2">
                        User Info
                    </div>
                     <form action="{{route('affilate.create')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" id="Full Name" name="name" placeholder="Full Name">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="inputEmail3"
                                placeholder="Email_me@example.com" name="email">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter your Address">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="password" >
                        </div>
                        <div class="form-group">

                            <input type="password" class="form-control" name="password_confirmation" id="confirm-password" placeholder="confirm password" >
                        </div>
                        <div class="form-group">
                            <label f    or="">How will you Affilate?</label>
                            <textarea name="description" id="" cols="10" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-box-title px-3 py-2">
                            Verification info
                        </div>
                        <div class="form-group">

                            <input type="text" class="form-control" id="Full Name" name="phone_number" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection