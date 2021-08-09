@extends('backend.body')
@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h1>In House Sales Report</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Report</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Commission Report</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row clearfix justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Products
                                <small>Wise Sales Report</small>
                            </h2>
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <form class="" action="{{route('reports.commission')}}" method="GET">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-tasks"></i> &nbsp;Sort By Vendor:</span>
                                            </div>
                                            <?php
                                            $user = \App\User::where('user_type', 'vendor')->get();
                                            ?>
                                            <select id="select_user" class="demo-select2 form-control py-2"
                                                    name="user_id"
                                                    required>
                                                <option value="" selected disabled>--Search By vendor name--</option>
                                                @foreach ($user as $key => $user)
                                                    <option value="{{ $user->id }}">{{ __($user->name) }}</option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-default" type="submit">Filter</button>

                                        </div>

                                    </div>
                                </form>
                                <table class="table table-striped table-hover dataTable" id="commission_table">
                                    <thead>
                                    <tr>
                                        <th>Vendor Name</th>
                                        <th>Commission</th>
                                        <th>Commission updated date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($commission as $key => $commission)
                                        <tr class="text-capitalize">
                                            <td>{{ __($commission->user->name) }}</td>
                                            {{--<td>{{ __($vendor) }}</td>--}}
                                            <td>{{ __($commission->admin_to_pay) }}</td>
                                            <td>{{date('Y M d D', strtotime($commission->updated_at))}}</td>
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

@endsection

