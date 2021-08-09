@extends('backend.body')

@section('body')

    <!-- Basic Data Tables -->
    <!--===================================================-->

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Payment History</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">History</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row clearfix">

                    <div class="card">
                        <div class="body">
                            <div class="panel-heading">
                                <h3 class="heading badge badge-primary">{{__('Seller Payments')}}</h3>
                            </div>

                            <div class="table-responsive">
                                <table class="table header-border table-hover  spacing5">
                                    <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Seller')}}</th>
                                        <th>{{__('Amount')}}</th>
                                        <th>{{ __('Payment Method') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($payments as $key => $payment)
                                        @if (\App\Seller::find($payment->seller_id) != null && \App\Seller::find($payment->seller_id)->user != null)
                                            <tr class="text-center">
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $payment->created_at }}</td>
                                                <td>
                                                    @if (\App\Seller::find($payment->seller_id) != null)
                                                        {{ \App\Seller::find($payment->seller_id)->user->name }}
                                                        ({{ \App\Seller::find($payment->seller_id)->user->shop->name }}
                                                        )
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ single_price($payment->amount) }}
                                                </td>
                                                <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }} @if ($payment->txn_code != null)
                                                        (TRX ID : {{ $payment->txn_code }}) @endif</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="clearfix">
                                    <div class="pull-right">
                                        {{ $payments->appends(request()->input())->links() }}
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="pull-right">
                                    {{ $payments->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
