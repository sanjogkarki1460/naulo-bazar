@extends('backend.body')

@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Coupons List</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Coupons</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="{{url()->previous()}}"
                           class="btn btn-sm btn-warning btn-round" title=""><i class="fa fa-backward"></i> Go Back</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="body">
                    <form class="form-horizontal" action="{{ route('coupons.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-code"></i> &nbsp;Coupon Type</span>
                                </div>
                                    <select name="coupon_type" id="coupon_type" class="form-control demo-select2"
                                            onchange="coupon_form()" required>
                                        <option value="">Select Coupon Type</option>
                                        <option value="product_base">For Products</option>
                                        <option value="cart_base">For Total Orders</option>
                                    </select>
                                </div>
                            </div>
                            <div id="coupon_form">

                            </div>

                            <div class="panel-footer text-right">
                                <button class="btn btn-outline-dark" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

    <script type="text/javascript">

        function coupon_form() {
            var coupon_type = $('#coupon_type').val();
            $.post('{{ route('coupons.get_coupon_form') }}', {
                _token: '{{ csrf_token() }}',
                coupon_type: coupon_type
            }, function (data) {
                $('#coupon_form').html(data);

                $('#demo-dp-range .input-daterange').datepicker({
                    startDate: '-0d',
                    todayBtn: "linked",
                    autoclose: true,
                    todayHighlight: true
                });
            });
        }

    </script>

@endpush
