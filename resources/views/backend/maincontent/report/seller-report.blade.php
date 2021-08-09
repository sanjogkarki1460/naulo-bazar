@extends('backend.body')
@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h1>Seller Report</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Report</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Seller Report</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row clearfix justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <form class="" action="{{route('reports.seller')}}" method="GET">
                                    <div class="d-flex justify-content-center">
                                        <div class="mr-3 pt-3">
                                            <p class="bold">Sort By
                                                Verification Status
                                            </p>
                                        </div>
                                        <div class="select py-2">
                                            <select class="demo-select2 form-control" name="verification_status" required>
                                                <option value="1"{{isset($status) && $status == '1' ? 'selected' : ''}}>
                                                    Approved
                                                </option>
                                                <option value="0" {{isset($status) && $status == '0' ? 'selected' : ''}}>
                                                    Not Approved
                                                </option>
                                            </select>
                                        </div>
                                        <div class="ml-4 pt-2">
                                            <button class="btn btn-outline-info text-right" type="submit">Filter
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <table class="table table-striped table-hover dataTable">
                                    <thead>
                                    <tr>
                                        <th><b>Vendor Name</b></th>
                                        <th><b>Email</b></th>
                                        <th><b>Shop Name</b></th>
                                        <th><b>Status</b></th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Vendor Name</th>
                                        <th>Email</th>
                                        <th>Shop Name</th>
                                        <th>Status</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                   @foreach ($sellers as $key => $seller)
                            @if($seller->user != null)
                                <tr>
                                    <td>{{ $seller->user->name }}</td>
                                    <td>{{ $seller->user->email }}</td>
                                    <td>{{ $seller->user->shop->name }}</td>
                                    <td>
                                        @if ($seller->verification_status == 1)
                                            <div class="label label-table label-success">
                                                {{__('Verified')}}
                                            </div>
                                        @elseif ($seller->verification_info != null)
                                            <a href="{{ route('sellers.show_verification_request', $seller->id) }}">
                                                <div class="label label-table label-info">
                                                    {{__('Requested')}}
                                                </div>
                                            </a>
                                        @else
                                            <div class="label label-table label-danger">
                                                {{__('Not Verified')}}
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endif
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