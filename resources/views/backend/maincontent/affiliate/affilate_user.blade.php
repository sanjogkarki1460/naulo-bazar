@extends('backend.body')
@section('title', isset($coupon) ? $coupon->title : 'Affiliate User ')
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
                <div class="tab-content mt-0">

                    <div class="tab-pane show active" id="Pages">
                        <div class="card">
                            <div class="header card-header">
                                <h6 class="title mb-0">All Affilate User</h6>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email Address</th>
                                                <th>Approval</th>
                                                <th>Due Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td></td>
                                                <td>
                                                    <div class="font-15"></div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    
                                                    <a href=""
                                                        class="btn btn-sm btn-default"><i
                                                            class="fa fa-edit text-info"></i></a>
                                                    <form id="deleteContact"
                                                        action=""
                                                        method="Post" style="display: inline">

                                                        <a href="#" id="contactDelete"
                                                            class="btn btn-sm btn-default js-sweetalert" title="Delete"
                                                            data-type="confirm"><i
                                                                class="fa fa-trash-o text-danger"></i></a>
                                                    </form>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    {{-- {{$products->links()}} --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--View Modal--}}
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" id="contactView" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title h4" id="myLargeModalLabel">Detail of <span id="title"></span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="name" class="font-weight-bold">Coupon Name:</label>
                                            <span id="clientName"></span>
                                        </div>
                                        <div class="col-6">
                                            <label for="email" class="font-weight-bold">Expiry Date:</label>
                                            <span id="clientEmail"></span>
                                        </div>
                                        <div class="col-6">
                                            <label for="subject" class="font-weight-bold">Coupon Code:</label>
                                            <span id="subject"></span>
                                        </div>
                                        <div class="col-6">
                                            <label for="address" class="font-weight-bold">Price:</label>
                                            <span id="address"></span>
                                        </div>
                                        <div class="col-6">
                                            <label for="phone" class="font-weight-bold">Type:</label>
                                            <span id="clientPhone"></span>
                                        </div>
                                        <div class="col-6">
                                            <label for="phone" class="font-weight-bold">Status:</label>
                                            <span id="clientStatus"></span>
                                        </div>
                                        <div class="col-12">
                                            <label for="message" class="font-weight-bold">Description:</label>
                                            <br>
                                            <span id="clientMessage"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--End Modal--}}
                    <div class="clearfix"></div>

                    <div class="col-md-12">
                        <a href="" class="btn btn-outline-danger">CANCEL</a>


                        <button type="submit" style="float: right;" class="btn btn-outline-success">
                            SAVE
                        </button>

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
