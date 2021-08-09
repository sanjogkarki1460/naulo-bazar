@extends('frontend.body.account.index')
@section('account')
<div class="col-md-8 mb-5 py-5">
    <div class="pt-5 mt-2"></div>
<form action="{{route('user.updateprofile')}}" class="row" method="post">
    @csrf
        <div class="col-md-6">
            <div class="form-group">
                <label for="account-fn">Name</label>
                <input class="form-control" type="text" name="name" id="account-fn" value="{{Auth::user()->name}}" required>
            </div>  
        </div>
        
        <div class="col-md-6">
            
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="account-email">E-mail Address</label>
                <input class="form-control" type="email" name="email"  id="account-email" value="{{Auth::user()->email}}"
                    disabled>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="account-phone">Phone Number</label>
                <input class="form-control" type="text" id="account-phone" name="phonenumber" value="{{Auth::user()->phonenumber}}" placeholder="{{Auth::user()->phonenumber ?? 'No phonenumber'}}" required>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="account-confirm-pass">Confirm Password</label>
                <input class="form-control" type="password" name="confirmpassword" id="account-confirm-pass">
            </div>
        </div>
        
        <div class="col-12">
            <hr class="mt-2 mb-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                
                <button class="btn btn-primary margin-right-none" type="submit" data-toast
                    data-toast-position="topRight" data-toast-type="success"
                    data-toast-icon="icon-circle-check" data-toast-title="Success!"
                    data-toast-message="Your profile updated successfuly.">Update Profile
                </button>
                <button class="btn btn-primary margin-right-none" type="button" data-toggle="modal" data-target="#exampleModal" data-toast
                data-toast-position="topRight" data-toast-type="success"
                data-toast-icon="icon-circle-check" data-toast-title="Success!"
                data-toast-message="Your profile updated successfuly.">Change Password
                </button>
                <!-- Modal -->
          
            </div>
        </div>
    </form>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="{{route('update.password')}}" method="post">
                @csrf   
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="account-email">Old Password</label>
                            <input class="form-control" type="password" id="account-email" name="old_password">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="account-phone">New Password</label>
                            <input class="form-control" type="password" id="account-phone" name="password" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="account-confirm-pass">Confirm Password</label>
                            <input class="form-control" type="password" name="password_confirmation" id="account-confirm-pass">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
            </div>
        </div>
        </div>
    </div>  
</div>
@endsection