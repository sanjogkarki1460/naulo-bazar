@extends('backend.body')

@section('body')

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
                    <div class="text-right p-3">
                        <div class="invoice-text">
                            <h5 class="h5 badge badge-primary">{{ __('Order Details') }}</h5>
                        </div>
                    </div>
                    <hr class="bg-blue">
                    <div class="container">
                        <div class="invoice-bill row">
                            <div class="col-md-6 ">
                                <address>
                                    <strong class="text-main">{{ json_decode($order->shipping_address)->name }}</strong><br>
                                    {{ json_decode($order->shipping_address)->email }}<br>
                                    {{ json_decode($order->shipping_address)->phone }}<br>
                                    {{ json_decode($order->shipping_address)->address }}
                                    , {{ json_decode($order->shipping_address)->city }}
                                    , {{ json_decode($order->shipping_address)->country }}
                                </address>
                                @if ($order->manual_payment && is_array(json_decode($order->manual_payment_data, true)))
                                    <br>
                                    <strong class="text-main">{{ __('Payment Information') }}</strong><br>
                                    Name: {{ json_decode($order->manual_payment_data)->name }},
                                    {{--                        Amount: {{ single_price(json_decode($order->manual_payment_data)->amount) }}, TRX--}}
                                    ID: {{ json_decode($order->manual_payment_data)->trx_id }}
                                    <br>
                                    <a href="{{ asset(json_decode($order->manual_payment_data)->photo) }}"
                                       target="_blank"><img
                                                src="{{ asset(json_decode($order->manual_payment_data)->photo) }}"
                                                alt="" height="100"></a>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <table class="invoice-details">
                                    <tbody>
                                    <tr>
                                        <td class="text-main text-bold">
                                            {{__('Order #')}}
                                        </td>
                                        <td class="text-right text-info text-bold">
                                            {{ $order->code }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-main text-bold">
                                            {{__('Order Status')}}

                                        </td>
                                        @php
                                            $status = $order->orderDetails->first()->delivery_status;
                                        @endphp
                                        <td class="text-right">
                                            <select class="form-control mb-3 selectpicker"
                                                    data-placeholder="{{__('Filter by Payment Status')}}"
                                                    name="delivery_status"
                                                    onchange="sort_orders()">
                                                <option value="">{{__('Filter by Deliver Status')}}</option>
                                                <option value="pending"
                                                        @isset($status) @if($status == 'pending') selected @endif @endisset>{{__('Pending')}}</option>
                                                <option value="on_review"
                                                        @isset($status) @if($status == 'on_review') selected @endif @endisset>{{__('On review')}}</option>
                                                <option value="on_delivery"
                                                        @isset($status) @if($status == 'on_delivery') selected @endif @endisset>{{__('On delivery')}}</option>
                                                <option value="delivered"
                                                        @isset($status) @if($status == 'delivered') selected @endif @endisset>{{__('Delivered')}}</option>
                                            </select>
                                            @if($status == 'delivered')
                                                <span
                                                        class="badge badge-success">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                                            @else
                                                <span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-main text-bold">
                                            {{__('Order Date')}}
                                        </td>
                                        <td class="text-right">
                                            {{ date('d-m-Y h:i A', $order->date) }} (UTC)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-main text-bold">
                                            {{__('Total amount')}}
                                        </td>
                                        <td class="text-right">
                                            {{--                                {{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}--}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-main text-bold">
                                            {{__('Payment method')}}
                                        </td>
                                        <td class="text-right">
                                            {{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-bordered invoice-summary">
                                <thead>
                                <tr class="bg-trans-dark">
                                    <th class="min-col">#</th>
                                    <th width="10%">
                                        {{__('Photo')}}
                                    </th>
                                    <th class="text-uppercase">
                                        {{__('Description')}}
                                    </th>
                                    <th class="text-uppercase">
                                        {{__('Size')}}
                                    </th>
                                    <th class="text-uppercase">
                                        {{__('Delivery Type')}}
                                    </th>
                                    <th class="min-col text-center text-uppercase">
                                        {{__('Qty')}}
                                    </th>
                                    <th class="min-col text-center text-uppercase">
                                        {{__('Price')}}
                                    </th>
                                    <th class="min-col text-right text-uppercase">
                                        {{__('Total')}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($order->orderDetails as $key => $orderDetail)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            @if ($orderDetail->product != null)
                                                <a href="{{ route('product', $orderDetail->product->slug) }}"
                                                   target="_blank"><img height="50"
                                                                        src={{ asset($orderDetail->product->thumbnail_img) }}/></a>
                                            @else
                                                <strong>{{ __('N/A') }}</strong>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($orderDetail->product != null)
                                                <strong><a href="{{ route('product', $orderDetail->product->slug) }}"
                                                           target="_blank">{{ $orderDetail->product->name }}</a></strong>
                                            <!--<small>{{ $orderDetail->variation }}</small>-->
                                            @else
                                                <strong>{{ __('Product Unavailable') }}</strong>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($orderDetail->product != null)

                                                <strong>{{ $orderDetail->variation }}</strong>
                                            @else
                                                <strong>{{ __('Product Unavailable') }}</strong>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
                                                {{ __('Home Delivery') }}
                                            @elseif ($orderDetail->shipping_type == 'pickup_point')
                                                @if ($orderDetail->pickup_point != null)
                                                    {{ $orderDetail->pickup_point->name }}
                                                    ({{ __('Pickup Point') }})
                                                @else
                                                    {{ __('Pickup Point') }}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $orderDetail->quantity }}
                                        </td>
                                        <td class="text-center">
                                            {{--                                    {{ single_price($orderDetail->price/$orderDetail->quantity) }}--}}
                                        </td>
                                        <td class="text-center">
                                            {{--                                    {{ single_price($orderDetail->price) }}--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="clearfix">
                        <table class="table invoice-total">
                            <tbody>
                            <tr>
                                <td>
                                    <strong>{{__('Sub Total')}} :</strong>
                                </td>
                                <td>
                                    {{--                            {{ single_price($order->orderDetails->sum('price')) }}--}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>{{__('Coupon')}} :</strong>
                                </td>
                                <td>
                                    {{--                            {{ single_price($order->coupon_discount) }}--}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>{{__('Tax')}} :</strong>
                                </td>
                                <td>
                                    {{--                            {{ single_price($order->orderDetails->sum('tax')) }}--}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>{{__('Shipping')}} :</strong>
                                </td>
                                <td>
                                    {{--                            {{ single_price($order->orderDetails->sum('shipping_cost')) }}--}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>{{__('TOTAL')}} :</strong>
                                </td>
                                <td class="text-bold h4">
                                    {{--                            {{ single_price($order->grand_total) }}--}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right no-print">
                        <a href="{{ route('customer.invoice.download', $order->id) }}"
                           class="btn btn-default"><i
                                    class="demo-pli-printer icon-lg"></i></a>
                    </div>
                </div>
            </div>
@endsection
