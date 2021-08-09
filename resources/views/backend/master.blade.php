<!doctype html>
<html lang="en">
<?php
$favicon=\App\Setting::first();
?>
<head>
    <title>@yield('title','Naulo Bazar')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
          content="zholaa Dashboard">
    <meta name="keywords"
          content="">
    <meta name="author" content="">

    <link rel="icon" href="{{asset('storage/setting/favicon/'.$favicon->favicon)}}" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/animate-css/vivify.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jvectormap/jquery-jvectormap-2.0.3.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/c3/c3.min.css') }}"/>
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('backend/html/assets/css/site.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/sweetalert/sweetalert.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/toastr/toastr.min.css') }}">

    {{-- Jquery tables --}}
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{ asset('backend/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{ asset('backend/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('backend/assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/summernote/dist/summernote.css') }}"/>
    <link rel="stylesheet" href="{{asset('backend/assets/vendor/nouislider/nouislider.min.css')}}">

    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/select2/css/select2.min.css') }}">
    {{--    <link rel="stylesheet" href="{{asset('backend/css/active-shop.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('backend/css/spectrum.css')}}">

    <link href="{{asset('backend/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.css')}}" rel="stylesheet">

    @stack('styles')

</head>

<body class="theme-cyan font-montserrat @if (!\Request::is('login'))   light_version @endif">
<!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="bar1"></div>
                <div class="bar2"></div>
            </div>
        </div>
<!-- Theme Setting -->
{{-- @include('backend.theme') --}}

<!-- Overlay For Sidebars -->
<div class="overlay">

</div>

@yield('content')

<!-- Javascript -->
<script src="{{asset('backend/html/assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('backend/html/assets/bundles/vendorscripts.bundle.js')}}"></script>

<script src="{{asset('backend/html/assets/bundles/knob.bundle.js')}}"></script><!-- Jquery Knob-->
<script src="{{asset('backend/html/assets/bundles/c3.bundle.js')}}"></script>
<script src="{{asset('backend/html/assets/bundles/flotscripts.bundle.js')}}"></script><!-- flot charts Plugin Js -->
<script src="{{asset('backend/html/assets/bundles/jvectormap.bundle.js')}}"></script><!-- JVectorMap Plugin Js -->

<script src="{{asset('backend/html/assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('backend/html/assets/js/index4.js')}}"></script>
<!-- other scripts -->
<script src="{{ asset('backend/assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
<!-- Bootstrap Colorpicker Js -->
<script src="{{ asset('backend/assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>
<!-- Input Mask Plugin Js -->
<script src="{{ asset('backend/assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<!-- Multi Select Plugin Js -->

<script src="{{ asset('backend/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('backend/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<!-- Bootstrap Tags Input Plugin Js -->
<script src="{{ asset('backend/assets/vendor/nouislider/nouislider.js') }}"></script><!-- noUISlider Plugin Js -->
<script src="{{ asset('backend/html/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
<script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js')}}"></script>
<script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js')}}"></script>

<script src="{{ asset('backend/assets/switchery/switchery.js')}}"></script>

<script src="{{asset('backend/html/assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('backend/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/html/assets/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="{{ asset('backend/html/assets/js/chart.min.js') }}"></script>
<script src="{{ asset('backend/html/assets/js/dropzone.js') }}"></script>
{{--<script src="{{asset('backend/js/app.js')}}"></script>--}}
<script src="{{asset('backend/js/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('backend/assets/vendor/select2/js/select2.full.js') }}"></script>
<script src="{{ asset('backend/js/spartan-multi-image-picker-min.js') }}"></script>
<script src="{{asset('backend/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>


@if (session('status'))
    <script>
        $(function () {
            toastr.success("{{ session('status') }}");
        });

    </script>
@endif
@if (session('error'))
    <script>
        $(function () {
            toastr.error("{{ session('error') }}");
        });

    </script>
@endif
@if ($errors->any())
    @foreach ($errors->all() as $key=>$error)
        <script>
            $(function () {
                toastr.error("{{ $error }}");
            });

        </script>
    @endforeach
@endif
<script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js')}}"></script>
<script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js')}}"></script>
<script src="{{ asset('backend/assets/vendor/summernote/dist/summernote.js') }}"></script>
<script>
    $(".summernote").summernote({
        disableResizeEditor: true,
        height: 300,
        width: '100%',
    });
</script>

<script type="text/javascript">
    function confirm_modal(delete_url) {
        jQuery('#confirm-delete').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href', delete_url);
    }
</script>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">{{__('Confirmation')}}</h4>
            </div>

            <div class="modal-body">
                <p>Are You Sure You Want To Delete ?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Cancel')}}</button>
                <a id="delete_link" class="btn btn-danger btn-ok">{{__('Delete')}}</a>
            </div>
        </div>
    </div>
</div>


@stack('scripts')
</body>

</html>
