@extends('frontend.body.auth.index')
@section('body')
<div  class="login__form">
    <div class="container">
        <div class="row align-items-center box-shadow my-5 py-3">
            <div class="col-sm-6">
                <div class="position-relative  ">
                    <div class="p-2 login-img">
                        <figure><img src="{{ asset('frontend/images/login.svg') }}" alt=""></figure>
                    </div>
                    <div class="register-wrap" style="visibility: hidden; left: -100px;">
                            <div class="form-title-in">
                                <div class="title ">
                                    <h3 class="">
                                        Register To Continue
                                    </h3>
                                </div>
                                <div class="my-4 text-muted">
                                    <span>Welcome, please <strong>Register</strong> to Your account</span>
                                </div>
                            </div>
                            <form action="{{route('register')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Full Name" name="name" placeholder="Full Name">
                                </div>
                                <div class="form-group">

                                    <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email_me@example.com">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="password" >
                                </div>
                                <div class="form-group">

                                    <input type="password" class="form-control" name="password_confirmation" id="confirm-password" placeholder="confirm password" >
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="phone-number" name="phonenumber" placeholder="phone number">
                                </div>
                                <div class="form-group">
                                    <select name="role" id="" class="form-control">
                                        <option value="">Are You?</option>
                                        <option value="buyer">Buyer</option>
                                        <option value="seller">Seller</option>
                                    </select>
                                </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Sign Up</button>
                                    </div>
                            </form>
                            <div class="already-member my-3 ">
                                <span class="font-weight-bold mr-2"> Already Member?</span> <a href="javascript:void(0)" class="btn-link "> SignIn Now</a>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="position-relative  ">
                <div class="login-wrap">
                    <div class="form-title-in">
                        <div class="title ">
                            <h3 class="">
                                Log In To Continue
                            </h3>
                        </div>
                        <div class="my-4 text-muted">
                            <span>Welcome, please login to Your account</span>
                        </div>
                    </div>
                    <form action="{{route('check.login')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="inputEmail3"  class="col-form-label">Email</label>
            
                            <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email_me@example.com">
            
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-form-label">Password</label>
            
                            <input type="password"  name="password" class="form-control" id="inputPassword3" >
            
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label mb-2" for="defaultCheck1">
                               Remember me?
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </div>
                        </div>
                    </form>
                    <div class="form-group">
                    {{-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                    </fb:login-button> --}}
                    <div class="fb-login-button" id="status" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width="">

                    </div>
                    </div>
                    <div class="not-yet my-3 ">
                       <span class="font-weight-bold mr-2"> Not a Member?</span> <a href="javascript:void(0)" class="btn-link "> SignUp Now</a>
                    </div>
                </div>
                <div class="register-img" style="visibility: hidden; right: -100px;">
                    <figure><img src="{{ asset('frontend/images/login.svg')}}" alt=""></figure>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>

  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();  
    } else {                                 // Not logged into your webpage or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this webpage.';
    }
  }

  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '656925345025408',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v8.0'           // Use this Graph API version for this call.
    });


    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      statusChangeCallback(response);        // Returns the login status.
    });
  };
 
  function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }

</script>

<!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
@endpush