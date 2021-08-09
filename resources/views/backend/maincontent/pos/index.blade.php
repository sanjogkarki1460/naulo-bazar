@extends('backend.body')
@section('body')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">

                    <h2>Pos Order</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"> Manage Your Order Here</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary btn-round"><i
                            class="fa fa-angle-double-left"></i> Go Back</a>
                    <a href="{{ route('pos.create') }}" class="btn btn-outline-success btn-round"><i
                            class="fa fa-plus"></i> Create Order</a>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="table-responsive">
                        <table id="only-bodytable" class="table table-hover table-custom spacing8">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th class="w60">Order No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th class="w100">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($pos_order))
                            @foreach($pos_order as $key => $order)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td class="width45">
                                        {{ $order->order_no  }}
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $order->user_name}}</h6>
                                    </td>
                                    <td>
                                        {{$order->total_price}}
                                    </td>
                                    <td>
                                        {{ date('d M, Y',strtotime($order->created_at)) }}
                                    </td>
                                    <td>
                                        @if($order->status == 0)
                                            <div class="badge badge-info">Pending</div>
                                        @elseif($order->status == 1)
                                            <div class="badge badge-warning">on Process</div>
                                        @elseif($order->status == 2)
                                            <div class="badge badge-success">Delivered</div>
                                        @else
                                            <div class="badge badge-danger">Cancelled</div>
                                        @endif
                                    </td>
                                    <td>

                                        <a data-toggle="modal" data-target="#orderModal{{$order->id}}" class="btn btn-sm btn-success center-block"
                                           title="View"><i class="fa fa-eye"></i></a>
                                        <a href="#delete"
                                           data-toggle="modal"
                                           data-id="{{ $order->id }}"
                                           id="delete{{ $order->id }}"
                                           class="btn btn-sm btn-danger center-block"
                                           onClick="delete_menu({{ $order->id }} )"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="orderModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Order Detail</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Name</h5>
                                                <p>{{$order->user_name}}</p>
                                                <h5>Shipping Details</h5>
                                                <p>{{$order->shipping_details}}</p>
                                                <h5>Billing Details</h5>
                                                <p>{{$order->billing_details}}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                @endif
                            </tbody>
                        </table>
{{--                        {{ $orders->links() }}--}}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Page</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <p>Are you Sure...!!</p>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                        <a href="" class="btn btn-round btn-primary">Delete</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
@push('scripts')
    <script>
        function delete_menu(id) {
            var conn = './pos/delete/' + id;
            $('#delete a').attr("href", conn);
        }
    </script>

@endpush
