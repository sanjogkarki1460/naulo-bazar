@extends('backend.body')
@section('title', isset($coupon) ? $coupon->title : 'Checkout API')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/nestable/jquery-nestable.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/summernote/dist/summernote.css') }}" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@endpush
@section('body')
<div id="main-content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <ul class="nav nav-tabs">
                    @if($id == 0)
                    <li class="nav-item">
                        <a class="nav-link show  active" data-toggle="tab"
                            href="#Pages">{{ isset($market) ? $market->title : 'Esewa' }}</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ $id != 0 ? 'show active' : '' }}" data-toggle="tab"
                            href="#addPage">{{ $id == 0 ? 'Paypal' : 'Update Coupons' }}</a>
                    </li>
                </ul>
                <div class="tab-content mt-0">
                    @if($id == 0)
                    <div class="tab-pane show active" id="Pages">
                        <div class="card">
                            <div class="eader card-header">
                                <h6 class="title mb-0">{{ isset($market) ? $market->name : 'Add API' }}</h6>
                            </div>
                            <div class="body">
                                <form method="post"
                                    action="{{ route('api.checkout.esewa')}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @php
                                        $esewa = App\Models\ApiIntegration::where('title','esewa')->first();
                                        if(isset($esewa))
                                        {
                                            $values=json_decode($esewa->values);
                                        }
                                    @endphp
                                    <div class="card">
                                        <div class="row clearfix">
                                            <div class="col-md-8">
                                                <div class="card" >
                                                    <div class="card-header">
                                                        API Intregation
                                                    </div>
                                                    <div class="body">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            Merchant ID
                                                                        </div>
                                                                    </div>
                                                                    <input type="text"
                                                                        value="{{ isset($values->merchant_id) ? $values->merchant_id  : null }}"
                                                                        name="value[merchant_id]" class="form-control" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-5">
                                                                <div class="input-group mb-3">
                                                                    <select name="mode" id="category"
                                                                        class="form-control">
                                                                        <option value=""
                                                                            class="text-info font-weight-bold">Mode
                                                                        </option>
                                                                        <option value="production"
                                                                        class="text-info font-weight-bold">Production
                                                                         </option>
                                                                         <option value="development"
                                                                            class="text-info font-weight-bold">Development
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-6">
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            Password
                                                                        </div>
                                                                    </div>
                                                                    <input type="text"
                                                                        value="{{ isset($values->merchant_password) ? $values->merchant_password  : null }}"
                                                                        name="value[merchant_password]" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="col-md-12">
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" class="form-control"
                                                                        value="API Status" disabled>
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <input type="checkbox" name="status"
                                                                                    value="1" checked></div>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="clearfix"></div>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" style="float: right;" class="btn btn-outline-success">
                            SAVE
                        </button>
                    </div>
                    </div>

                </form>
                    @endif

                    <div class="tab-pane {{ $id != 0 ? 'show active' : '' }}" id="addPage">
                        <div class="card">
                            <div class="header card-header">
                                <h6 class="title mb-0">{{ isset($market) ? $market->name : 'Add API' }}</h6>
                            </div>
                            <div class="body mt-2">
                                <form method="post"
                                    action="{{ $id == 0 ? route('api.checkout.paypal') : route('coupons.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @php
                                        $paypal = App\Models\ApiIntegration::where('title','paypal')->first();
                                        if(isset($paypal))
                                        {
                                            $values=json_decode($paypal->values);
                                        }
                                    @endphp
                                    <div class="card">
                                        <div class="row clearfix">
                                            <div class="col-md-8">
                                                <div class="card1" >
                                                    <div class="card-header">
                                                        API Intregation
                                                    </div>
                                                    <div class="body">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            Username
                                                                        </div>
                                                                    </div>
                                                                    <input type="text"
                                                                        value="{{ isset($values->username) ? $values->username  : null }}"
                                                                        name="value[username]" class="form-control" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-5">
                                                                <div class="input-group mb-3">
                                                                    <select name="mode" id="category"
                                                                        class="form-control">
                                                                        <option value=""
                                                                            class="text-info font-weight-bold">Mode
                                                                        </option>
                                                                        <option value="sandbox"
                                                                        class="text-info font-weight-bold">SandBox
                                                                         </option>
                                                                         <option value="live"
                                                                            class="text-info font-weight-bold">Live
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-7">
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            Password
                                                                        </div>
                                                                    </div>
                                                                    <input type="text"
                                                                        value="{{ isset($values->password) ? $values->password  : null }}"
                                                                        name="value[password]" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            Client Secret
                                                                        </div>
                                                                    </div>
                                                                    <input type="text"
                                                                        value="{{ isset($values->secret) ? $values->secret  : null }}"
                                                                        name="value[secret]" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            Client Certificate
                                                                        </div>
                                                                    </div>
                                                                    <input type="text"
                                                                        value="{{ isset($values->certificate) ? $values->certificate  : null }}"
                                                                        name="value[certificate]" class="form-control">

                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                {{-- <div class="card" id="optional">

                                                    </div> --}}
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card1">
                                                    <div class="card-header">
                                                        API Status
                                                    </div>
                                                    <div class="body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            @if(isset($coupon_edit))
                                                                            <input type="checkbox" name="status"
                                                                                value="1" @if($coupon_edit->status ==
                                                                            1)checked @else @endif></div>
                                                                        @else
                                                                        <input type="checkbox" name="status" value="1"
                                                                            checked>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    value="API Status" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>

                                            {{-- <a href="#" id="option" class="btn-btn info badge-info">Add Option</a> --}}
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-md-12">
                        @if ($id != 0)
                        <a href="{{ route('markets.index') }}" class="btn btn-outline-danger">CANCEL</a>

                        <button type="submit" style="float: right;" class="btn btn-outline-success">
                            UPDATE
                        </button>
                        @else
                        <button type="submit" style="float: right;" class="btn btn-outline-success">
                            SAVE
                        </button>
                        @endif
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="clearfix"></div>
<div class="col-md-12">

</div>

</div>

<div class="modal fade " id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6>View Product
                    <span id="viewDisplay"></span>
                    <span id="viewFeatured"></span>
                    <span id="viewStockStatus"></span>
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body pricing_page text-center pt-4 mb-4">
                <div class="card ">
                    <div class="card-header">
                        <h5 id="PageTitle"></h5>
                        <small class="text-muted" id="viewContent"></small>
                    </div>
                    <div class="card-body">
                        <img id="viewImage" class="img-fluid"
                            src="https://via.placeholder.com/1584x1058?text=Sample + Image + For + Product">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button style="text-align: right;" type="button" data-dismiss="modal"
                    class="btn btn-outline-danger">Close
                </button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade modal-danger" id="delete_image">
    <div class="modal-dialog " role="document">
        <div class="modal-content bg-warning">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLabel">Delete Gallery Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-white">
                <p>Are you Sure...!!</p>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                <a href="" class="btn btn-round btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

</div>

</div>
@endsection
@push('scripts')
<script src="{{ asset('backend/assets/vendor/nestable/jquery.nestable.js') }}"></script><!-- Jquery Nestable -->

<script src="{{ asset('backend/assets/vendor/summernote/dist/summernote.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(".summernote").summernote({
        disableResizeEditor: true,
        height: 300,
        width: '100%',
    });

</script>
<script>
    $( function() {
      $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "mm/dd/yy",
        minDate: new Date()

      });
      $( "#datepicker2" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "mm/dd/yy",
        minDate: new Date()

      });
    } );
    </script>
<script>
    function clientView(id, name, email, subject, address, message, phone, status) {
        $('#contactView').modal('show');
        $('#clientName').html(name);
        $('#clientEmail').html(email);
        $('#subject').html(subject);
        $('#address').html(address);
        $('#clientMessage').html(message);
        $('#clientStatus').html(status);
        $('#title').html(name);
        if (phone != '') {
            $('#clientPhone').html(phone)
        } else {
            $('#clientPhone').html('N/A');
        }

    }

    $('#contactDelete').click(function (e) {
        e.preventDefault();
        swal({
                title: "Are You Sure!",
                text: "Would you like to Delete item?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
            },
            function (isConfirm) {
                if (isConfirm) {
                    document.getElementById('deleteContact').submit();
                }
            }
        )
    });

</script>
@endpush
