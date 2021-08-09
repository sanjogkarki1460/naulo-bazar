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
                                <li class="breadcrumb-item"><a href="#">Roles and Permission</a></li>
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
                <div class="modal fade launch-pricing-modal" id='permissionModal' tabindex="-1" role="dialog"
                     aria-labelledby="myLargeModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Permission Create</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('permissions.create') }}" method="post" id="permissionForm">
                                    @csrf
                                    <input type="hidden" name="id" value="" id="permissionId">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input name="title" type="text" class="form-control" id="name"
                                               placeholder="Enter Permission's name here.." required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input name="display_name" type="text" class="form-control" id="displayName"
                                               placeholder="Display Name...." required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <textarea name="description" class="form-control" id="" cols="15" rows="5"
                                                  id='description'
                                                  placeholder="Enter Description...."></textarea>
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="saveBtn">Save changes</button>
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
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Users">Permission
                                    List</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#addUser">Assign
                                    Permission</a></li>
                        </ul>
                        <div class="tab-content mt-0">
                            <div class="tab-pane active show" id="Users">
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                            <thead>
                                            <tr>
                                                <th>Permission</th>
                                                <th>Role</th>
                                                <th>Created Date</th>
                                                <th class="w100">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($permissions as $key => $permission)

                                                <tr>
                                                    <td>
                                                        <h6 class="mb-0">{{ $permission->display_name }}</h6>
                                                        <span>{{ $permission->name }}</span>
                                                    </td>
                                                    <td>
                                                        @foreach($permission->roles as $role)
                                                            <span class="badge badge-danger">{{ $role->display_name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $permission->created_at }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-default"
                                                                title="Edit"><i class="fa fa-edit"
                                                                                onclick="showModal('{{$permission->id}}','{{$permission->name}}','{{$permission->display_name}}','{{$permission->description}}')"></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-sm btn-default js-sweetalert"
                                                                title="Delete" data-type="confirm"><i
                                                                    class="fa fa-trash-o text-danger"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="addUser">
                                <div class="body mt-2">
                                    <div class="row clearfix">

                                        <div class="col-12">
                                            <h6>Assign Permission</h6>
                                            <div class="body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped ">
                                                        <thead>
                                                        <tr>
                                                            <th>Permission Name</th>
                                                            @foreach($roles as $key => $role)
                                                                <th>{{ $role->display_name }}</th>
                                                            @endforeach
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($permissions as $key => $permission)
                                                            <tr>
                                                                <td>{{ $permission->display_name }}</td>

                                                                @foreach($roles as $key => $role)
                                                                    <td>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="hidden" class="role_id"
                                                                                   value="{{ $role->id }}">
                                                                            <input class="checkbox-tick" type="checkbox"
                                                                                   data-id="{{ $permission->id }}"
                                                                                   @if($role->hasPermission($permission->name)) checked @endif >
                                                                            <span></span>
                                                                        </label>
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            {{-- <button type="button" class="btn btn-primary">Add</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button> --}}
                                        </div>
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
        $(document).ready(function (e) {
            $('.checkbox-tick').click(function (e) {

                if ($(this).prop("checked") == true) {
                    alert("Checkbox is checked..");
                    var permission_id = $(this).attr("data-id");
                    var role_id = $(this).parent().find('.role_id').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: "{{ route('permissions.update') }}",
                        data: {permission_id: permission_id, role_id: role_id},
                        success: function (response) {
                            console.log(response);
                        }
                    });
                } else if ($(this).prop("checked") == false) {
                    var permission_id = $(this).attr("data-id");
                    var role_id = $(this).parent().find('.role_id').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: "{{ route('permissions.delete') }}",
                        data: {permission_id: permission_id, role_id: role_id},
                        success: function (response) {
                            console.log(response);
                        }
                    });
                    alert("Checkbox is unchecked..");
                }

            });
        });

        function showModal(id, name, title, description) {
            $('#permissionModal').modal('show');
            $('#name').val(name);
            $('#displayName').val(title);
            $('#description').value = description;
            $('#permissionId').val(id);
            if ($('#name').val() != '') {
                $('#saveBtn').html('Update Permission');
                var conn = '{{route('permissions.update')}}'
                $('#permissionForm').attr('action', conn);
            }
        }
    </script>
@endpush
