@extends('backend.body')
@section('title', 'Disputes Management')

@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12 mb-5">
                        <h2>Disputes Section</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Dispute</li>
                                <li class="breadcrumb-item active">All Dispute</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row clearfix">
                    <!-- Basic Data Tables -->
                    <!--===================================================-->
                    <div class="card">
                        <div class="body">
                            <table class="table table-striped table-hover table-bordered text-center"
                                   id="dispute-list">
                                <thead>
                                <tr>
                                    <th class="text-center">SN</th>
                                    <th class="text-center">Buyer Name</th>
                                    <th class="text-center">Reason</th>
                                    <th class="text-center">Seller Name</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($disputes))
                                    @foreach($disputes as $order_product)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{\App\User::where('id', $order_product->order->user_id)->first()->first_name}}</td>
                                            <td>{{\App\Dispute::where('order_product_id', $order_product->id)->first()->message}}</td>
                                            <td>{{\App\User::where('id', $order_product->owner_id)->first()->first_name}}</td>
                                            <td>
                                                @if(\App\Dispute::where('order_product_id', $order_product->id)->first()->status == '1')
                                                    <button class="btn btn-danger btn-xs dispute_status"
                                                            data-id="{{$order_product->id}}">Opened
                                                    </button>
                                                @elseif(\App\Dispute::where('order_product_id', $order_product->id)->first()->status == '0')
                                                    <button class="btn btn-success btn-xs dispute_status"
                                                            data-id="{{$order_product->id}}">Closed
                                                    </button>
                                                @else
                                                    <button class="btn btn-warning btn-xs dispute_status"
                                                            data-id="{{$order_product->id}}">Unapproved
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('disputes.view_details', \App\Dispute::where('order_product_id', $order_product->id)->first()->id)}}"><span
                                                            class="fa fa-eye text-danger"></span></a></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="text-center">SN</th>
                                    <th class="text-center">Buyer Name</th>
                                    <th class="text-center">Reason</th>
                                    <th class="text-center">Seller Name</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('document').ready(function () {
            $('#dispute-list').DataTable();
        });

        $(document).on("click", ".dispute_status", function (e) {
            e.preventDefault();
            var $this = $(this);

            var id = $this.attr('data-id');
            var tempUpdateUrl = "{{ route('disputes.status_update', ':id') }}";
            tempUpdateUrl = tempUpdateUrl.replace(':id', id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: tempUpdateUrl,
//            contentType: false,
//            processData: false,
//            cache: false,
                data: id,
                beforeSend: function (data) {
                },
                success: function (data) {
//                window.location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {

                },
                complete: function () {
                    window.location.reload();
                }
            });
        });
    </script>
@endpush