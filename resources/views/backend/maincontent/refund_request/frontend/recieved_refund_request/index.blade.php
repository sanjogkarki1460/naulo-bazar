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
                                <li class="breadcrumb-item active"><a href="#">Refund Request</a></li>
                               
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
                                    <h3 class="heading heading-6 text-capitalize strong-600 mb-0 p-3 badge badge-primary font-12">
                                        {{__('Recieved Refund Request')}}
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
                                            <th>{{__('Reason')}}</th>
                                            <th>{{__('Approval')}}</th>
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
                                                    <td>
                                                        <a href="{{ route('reason_show', $refund->id) }}"><span class="ml-2" style="color:green"><strong>{{__('Show')}}</strong></span></a>
                                                    </td>
                                                    <td>
                                                        @if ($refund->seller_approval == 1)
                                                            <label class="switch">
                                                                <input type="checkbox" @if ($refund->seller_approval == 1) checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        @else
                                                            <label class="switch">
                                                                <input onchange="update_refund_approval('{{ $refund->id }}')" type="checkbox" @if ($refund->seller_approval == 1) checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
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
    </section>

@endsection
@push('scripts')
    <script type="text/javascript">

        function update_refund_approval(el){
            $.post('{{ route('vendor_refund_approval') }}',{_token:'{{ @csrf_token() }}', el:el}, function(data){
                if (data == 1) {
                    showFrontendAlert('success', 'Approval has been done successfully');
                }
                else {
                    showFrontendAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endpush
