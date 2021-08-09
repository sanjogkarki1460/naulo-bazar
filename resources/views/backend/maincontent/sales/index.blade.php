@extends('backend.body')
@section('body')
    @php
        $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
    @endphp
    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Total Sales</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Sales</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="{{url()->previous()}}"
                           class="btn btn-sm btn-primary btn-round" title="">Go Back</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="body">
                    <div class="panel-heading bord-btm clearfix pad-all h-100">
                        <div class="header">
                            <h6 class="badge badge-primary py-2">Orders</h6>

                            <div class="pull-right clearfix">
                                <form class="" id="sort_orders" action="" method="GET">
                                    <div class="box-inline pad-rgt pull-left">
                                        <div class="" style="min-width: 200px;">
                                            <input type="text" class="form-control" id="search" name="search"
                                                   @isset($sort_search) value="{{ $sort_search }}"
                                                   @endisset placeholder="Type Order code & hit Enter">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table header-border table-hover  spacing5">
                            <thead>

                            <tr class="text-center font-weight-bolder">
                                <th>#</th>
                                <th>Order Code</th>
                                <th>Num. of Products</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Delivery Status</th>
                                <th>Payment Status</th>
                                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                    <th>Refund</th>
                                @endif
                                <th width="10%">Actions</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach ($orders as $key => $order)
                                <tr class="text-center">
                                    <td>
                                        {{ ($key+1) + ($orders->currentPage() - 1)*$orders->perPage() }}
                                    </td>
                                    <td>
                                        {{ $order->code }}
                                    </td>
                                    <td>
                                        {{ count($order->orderDetails) }}
                                    </td>
                                    <td>
                                        @if ($order->user != null)
                                            {{ $order->user->name }}
                                        @else
                                            Guest ({{ $order->guest_id }})
                                        @endif
                                    </td>
                                    <td>
                                        {{--                                                                                    {{ single_price($order->grand_total) }}--}}
                                    </td>
                                    <td>
                                        @php
                                            $status = 'Delivered';
                                            foreach ($order->orderDetails as $key => $orderDetail) {
                                                 $status = $orderDetail->delivery_status;

                                            }
                                        @endphp
                                        {{ $status }}
                                    </td>
                                    <td>
                            <span class="badge badge--2 mr-4">
                                @if ($order->payment_status == 'paid')
                                    <i class="bg-green"></i> Paid
                                @else
                                    <i class="bg-red"></i> Unpaid
                                @endif
                            </span>
                                    </td>
                                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                        <td>
                                            {{--                                                @if (count($order->refund_requests) > 0)--}}
                                            {{--                                                    {{ count($order->refund_requests) }} Refund--}}
                                            {{--                                                @else--}}
                                            No Refund
                                            {{--                                                @endif--}}
                                        </td>
                                    @endif

                                    <td>
                                        <a href="{{route('sales.show', encrypt($order->id))}}"><i class="fa fa-eye"></i></a>


                                        <a href="{{ route('customer.invoice.download', $order->id) }}"><i
                                                    class="fa fa-download"></i></a>

                                        <a onclick="confirm_modal('{{route('orders.destroy', $order->id)}}');"><i
                                                    class="fa fa-trash"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="clearfix">
                            <div class="pull-right">
                                {{ $orders->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
