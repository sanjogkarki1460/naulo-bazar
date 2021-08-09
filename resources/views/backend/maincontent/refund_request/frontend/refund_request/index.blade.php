@extends('backend.body')

@section('body')


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Refund Request</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="#">Sent Refund Request</a></li>
                           
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

                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h3 class="heading heading-6 text-capitalize strong-600 mb-0 font-12 badge badge-primary p-3">
                                        {{__('Applied Refund Request')}}
                                    </h2>
                                </div>
                              
                            </div>
                        </div>

                        <div class="card no-border mt-5">
                            <div class="card-header py-3">
                                <h4 class="mb-0 h6">Refund Request</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-responsive-md mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{__('Order id')}}</th>
                                            <th>{{__('Product')}}</th>
                                            <th>{{__('Amount')}}</th>
                                            <th>{{__('Status')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($refunds) > 0)
                                            @foreach ($refunds as $key => $refund)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($refund->created_at)) }}</td>
                                                    <td>
                                                        @if ($refund->order != null)
                                                            {{ $refund->order->code }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($refund->orderDetail != null && $refund->orderDetail->product != null)
                                                            {{ $refund->orderDetail->product->name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($refund->orderDetail != null)
                                                            {{single_price($refund->orderDetail->price)}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($refund->refund_status == 1)
                                                            <span class="ml-2" style="color:green"><strong>{{__('Approved')}}</strong></span>
                                                        @else
                                                            <span class="ml-2" style="color:red"><strong>{{__('PENDING')}}</strong></span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="text-center pt-5 h4" colspan="100%">
                                                    <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                                <span class="d-block">{{ __('No history found.') }}</span>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $refunds->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
