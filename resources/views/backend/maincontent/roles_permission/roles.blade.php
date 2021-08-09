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
                        <li class="breadcrumb-item"><a href="#">Roles and Permisson</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Assign Permission</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" data-toggle="modal"
                    data-target=".launch-pricing-modal" title="">Add New</a>
                </div>
            </div>
            <div class="modal fade launch-pricing-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Roles Create</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('roles.create') }}" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input name="title" type="text" class="form-control"
                                        placeholder="Enter role's name here.." required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input name="display_name" type="text" class="form-control"
                                        placeholder="Display Name...." required>
                                </div>
                                <div class="input-group mb-3">
                                    <textarea name="description" class="form-control" id="" cols="15" rows="5" placeholder="Enter Description...."></textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Users">Roles List</a></li>
                    </ul>
                    <div class="tab-content mt-0">
                        <div class="tab-pane active show" id="Users">
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                        <thead>
                                            <tr>
                                                <th>Roles Title</th>
                                                <th>Description</th>
                                                <th>Created Date</th>
                                                <th class="w100">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($roles as $key => $role)
                                            <tr>
                                                <td>
                                                    <h6 class="mb-0">{{ $role->display_name }}</h6>
                                                    <span>{{ $role->name }}</span>
                                                </td>
                                                <td>{{$role->description}}</td>
                                                <td>{{ $role->created_at }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-edit"></i></button>
                                                    <a href="{{route('roles.delete',$role->id)}}"  class="btn btn-sm btn-default js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(e){
        $('.checkbox-tick').click(function(e){

            if($(this).prop("checked") == true){
                alert("Checkbox is checked..");
                var permission_id =  $(this).attr("data-id");
                var role_id = $(this).parent().find('.role_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: "{{ route('permissions.update') }}",
                    data: {permission_id:permission_id,role_id:role_id},
                    success: function(response){
                        console.log(response);
                    }
                });
            }
            else if($(this).prop("checked") == false){
                var permission_id =  $(this).attr("data-id");
                var role_id = $(this).parent().find('.role_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: "{{ route('permissions.delete') }}",
                    data: {permission_id:permission_id,role_id:role_id},
                    success: function(response){
                        console.log(response);
                    }
                });
                alert("Checkbox is unchecked..");
            }

        });
    });
</script>
@endpush
