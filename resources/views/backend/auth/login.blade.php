@extends('backend.master')
@section('content')

<div class="auth-main particles_js">
    <div class="auth_div vivify popIn">
        <div class="auth_brand">
            <a class="navbar-brand" href="javascript:void(0);">Welcome To Dashboard</a>
        </div>
        <div class="card">
            <div class="body">
                <p class="lead">Login to your account</p>
                <form class="form-auth-small m-t-20" action=" {{url('auth/login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="signin-email" class="control-label sr-only">Email</label>
                        <input type="email" class="form-control round" id="signin-email" value="user@domain.com" name="email" placeholder="Email">
                        @if ($errors->has('email'))
                        <span class="error">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="signin-password" class="control-label sr-only">Password</label>
                        <input type="password" class="form-control round" name="password" id="signin-password" value="thisisthepassword" placeholder="Password">
                        @if ($errors->has('password'))
                        <span class="error">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group clearfix">
                        <label class="fancy-checkbox element-left">
                            <input type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-round btn-block">LOGIN</button>
                    <div class="bottom">
                        <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="page-forgot-password.html">Forgot password?</a></span>
                        <span>Don't have an account? <a href="page-register.html">Register</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</div>
@endsection
