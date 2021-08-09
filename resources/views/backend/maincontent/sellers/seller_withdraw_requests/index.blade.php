@extends('backend.body')

@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Seller WithDraw Section</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Sellers</li>
                                <li class="breadcrumb-item active">WithDraw Request</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="#" onclick="show_request_modal()"
                           class="btn btn-rounded btn-info pull-right">{{ __('Send Withdraw Request') }}</a>
                    </div>
                    
                </div>

               
                <div class="row clearfix">

                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table header-border table-hover  spacing5">
                                    <thead>
                                    <tr>
                                              

                                                    <th>#</th>

                                                    <th>{{__('Date')}}</th>

                                                    <th>{{__('Seller')}}</th>

                                                    <th>{{__('Total Amount to Pay')}}</th>

                                                    <th>{{__('Requested Amount')}}</th>

                                                    <th>{{ __('Message') }}</th>

                                                    <th>{{ __('Status') }}</th>

                                                    <th width="10%">{{__('Options')}}</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($seller_withdraw_requests as $key => $seller_withdraw_request)

                                                    @if (\App\Seller::find($seller_withdraw_request->user_id) != null && \App\Seller::find($seller_withdraw_request->user_id)->user != null)

                                                        <tr>

                                                            <td>{{ ($key+1) + ($seller_withdraw_requests->currentPage() - 1)*$seller_withdraw_requests->perPage() }}</td>

                                                            <td>{{ $seller_withdraw_request->created_at }}</td>

                                                            <td>

                                                                @if (\App\Seller::find($seller_withdraw_request->user_id) != null)

                                                                    {{ \App\Seller::find($seller_withdraw_request->user_id)->user->name }}
                                                                    ({{ \App\Seller::find($seller_withdraw_request->user_id)->user->shop->name }}
                                                                    )

                                                                @endif

                                                            </td>

                                                            <td>{{ single_price(\App\Seller::find($seller_withdraw_request->user_id)->admin_to_pay) }}</td>

                                                            <td>{{ single_price($seller_withdraw_request->amount) }}</td>

                                                            <td>

                                                                {{ $seller_withdraw_request->message }}

                                                            </td>

                                                            <td>

                                                                @if ($seller_withdraw_request->status == 1)

                                                                    <span class="ml-2"
                                                                          style="color:green"><strong>{{__('Paid')}}</strong></span>

                                                                @else

                                                                    <span class="ml-2"
                                                                          style="color:red"><strong>{{__('Pending')}}</strong></span>

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
                                                                            <a onclick="show_seller_payment_modal('{{$seller_withdraw_request->user_id}}','{{ $seller_withdraw_request->id }}');">{{__('Pay Now')}}</a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="{{route('sellers.payment_history', encrypt($seller_withdraw_request->user_id))}}">{{__('Payment History')}}</a>
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
                                    </div>
                                    <div class="pagination-wrapper py-4">
                                        <ul class="pagination justify-content-end">
                                            {{ $seller_withdraw_requests->links() }}
                                        </ul>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="request_modal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size"
                         role="document">
                        <div class="modal-content position-relative">
                            <div class="modal-header">
                                <h3 class="modal-title strong-600 heading-5 badge badge-primary font-12">{{__('Send A Withdraw Request')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="" action="{{ route('withdraw_requests.store') }}" method="post">
                                @csrf
                                <div class="modal-body gry-bg px-3 pt-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>{{__('Amount')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control mb-3" name="amount" min="1"
                                            max="{{ Auth::user()->seller->admin_to_pay ?? 'N/A' }}" placeholder="Amount" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>{{__('Message')}}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="message" rows="8" class="form-control mb-3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">{{__('Send')}}</button>
                                </div>
                            </form>
                            <div class="modal-body gry-bg px-3 pt-3">
                                <div class="p-5 heading-3">
                                    You don't have enough balance to send withdraw request
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="message_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative" id="modal-content">

            </div>
        </div>
    </div> --}}

@endsection
@push('scripts')
    <script type="text/javascript">
        function show_request_modal() {
            $('#request_modal').modal('show');
        }

        function show_message_modal(id) {
            $.post('{{ route('withdraw_request.message_modal') }}', {
                _token: '{{ @csrf_token() }}',
                id: id
            }, function (data) {
                $('#message_modal .modal-content').html(data);
                $('#message_modal').modal('show', {backdrop: 'static'});
            });
        }
    </script>
@endpush
