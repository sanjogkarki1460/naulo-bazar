@extends('backend.body')

@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12 mb-5">
                        <h2>Customers List</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Customers</li>
                                <li class="breadcrumb-item active">Customer Lists</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row clearfix">
                    <!-- Basic Data Tables -->
                    <!--===================================================-->
                    <div class="card">
                        <div class="body">
                            <h3 class="panel-title badge badge-primary p-3">{{__('Customers')}}</h3>
                            <div class="pull-right clearfix">
                                <form class="" id="sort_customers" action="" method="GET">
                                    <div class="box-inline pad-rgt pull-left">
                                        <div class="" style="min-width: 200px;">
                                            <input type="text" class="form-control" id="search" name="search"
                                                   @isset($sort_search) value="{{ $sort_search }}"
                                                   @endisset placeholder=" Type email or name & Enter">
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="table-responsive">
                                <table class="table header-border table-hover  spacing5">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Email Address')}}</th>
                                        <th>{{__('Phone')}}</th>
                                        <th>{{__('Package')}}</th>
                                        <th width="10%">{{__('Options')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customers as $key => $customer)
                                        @if ($customer->user != null)
                                            <tr>
                                                <td>{{ ($key+1) + ($customers->currentPage() - 1)*$customers->perPage() }}</td>
                                                <td>{{$customer->user->name}}</td>
                                                <td>{{$customer->user->email}}</td>
                                                <td>{{$customer->user->phone}}</td>
                                                <td>
                                                    @if ($customer->user->customer_package != null)
                                                        {{$customer->user->customer_package->name}}
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group dropdown">
                                                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon"
                                                                data-toggle="dropdown" type="button">
                                                            {{__('Actions')}} <i class="dropdown-caret"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a onclick="confirm_modal('{{route('customers.destroy', $customer->id)}}');">{{__('Delete')}}</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="clearfix">
                                <div class="pull-right">
                                    {{ $customers->appends(request()->input())->links() }}
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
    <script type="text/javascript">
        function sort_customers(el) {
            $('#sort_customers').submit();
        }
    </script>
@endpush
