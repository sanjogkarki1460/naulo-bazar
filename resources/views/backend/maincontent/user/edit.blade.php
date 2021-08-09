@extends('backend.body')
@section('body')

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>User List</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User List</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="#addUser"  data-toggle="tab" class="btn btn-sm btn-primary btn-round" title="">Add New</a>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Users">Users</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#addUser">Add User</a></li>
                    </ul>
                    <div class="tab-content mt-0">
                        <div class="tab-pane active show" id="Users">
                            <div class="table-responsive">
                                <table class="table table-hover table-custom spacing8">
                                    <thead>
                                        <tr>
                                            <th class="w60">Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created Date</th>
                                            <th class="w100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('backend/assets/images/xs/avatar4.jpg') }}" data-toggle="tooltip" data-placement="top" title="" alt="Avatar" class="w35 h35 rounded" data-original-title="Avatar Name">
                                            </td>
                                            <td>
                                                <h6 class="mb-0">{{ $user->name }}</h6>
                                                <span>{{ $user->email }}</span>
                                            </td>
                                          @php
                                              $role = $user->roles->first()->name;
                                          @endphp
                                            <td><span class="badge badge-success">{{ $role }}</span></td>
                                            <td>{{ $user->created_at->format('d M ,Y') }}</td>
                                            <td>
                                                <button type="button" onclick="window.location.href='{{ route('users.edit',$user->id) }}'" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-edit"></i></button>
                                                <button type="button" onclick="window.location.href='{{ route('users.delete',$user->id) }}'" class="btn btn-sm btn-default js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="addUser">
                            <div class="body mt-2">
                                <form action="{{ @if(!isset($user)) route('users.store') @else route('users.update') @endif }}" method="post">
                                    @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" value="" placeholder="Full Name *">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="email" placeholder="Email ID *">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <select name="role" class="form-control show-tick">
                                                <option value="">Select Role Type</option>
                                                <option value="superadministrator">Super Admin</option>
                                                <option value="vendor">Vendor</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
