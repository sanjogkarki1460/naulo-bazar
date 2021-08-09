@extends('backend.body')

@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Add New Product</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Products</a></li>
                                <li class="breadcrumb-item active" aria-current="page">New Products</li>
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
                    <form class="form-horizontal" action="{{ route('flash_deals.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="body mt-2">
                            <div class="header">
                                <h2 class="badge badge-primary">Flash Deal Information</h2>
                                <hr class="bg-blue">
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                        class="fa fa-text-width"></i> &nbsp;Title</span>
                                        </div>
                                        <input type="text" placeholder="{{__('Title')}}" id="name" name="title"
                                               class="form-control small"
                                               required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                  id="inputGroup-sizing-sm"><i class="fa favorite-color"></i>&nbsp;Background Color <span
                                                        class="badge bage-info">Hexa-Code</span></span>
                                        </div>
                                        <input type="text" placeholder="{{__('#FFFFFF')}}" id="background_color"
                                               name="background_color" class="form-control" required>

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Text Color</span>
                                        </div>
                                        <select name="text_color" id="text_color"
                                                class="form-control demo-select2"
                                                required>
                                            <option value="">Select One</option>
                                            <option value="white">{{__('White')}}</option>
                                            <option value="dark">{{__('Dark')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Banner <small>(1920*500)</small></span>
                                        </div>
                                        <input type="file" id="banner" name="banner" class="form-control">

                                    </div>
                                </div>


                                <div class="col-md-6">

                                    <label>Flash Deal Date</label>
                                    <div class="input-daterange input-group" data-provide="datepicker">
                                        <input type="text" class="input-sm form-control" name="start_date">
                                        <span class="input-group-addon range-to">To</span>
                                        <input type="text" class="input-sm form-control" name="end_date">
                                    </div>


                                </div>


                                <div class="col-md-6">

                                    <label>Products</label>
                                    <div class="multiselect_div">
                                        <select id="multiselect1"  name="products[]" id="products"
                                                class="multiselect form-control js-example-basic-multiple"
                                                multiple="multiple" required
                                                data-placeholder="Choose Products">
                                            @foreach(\App\Product::all() as $product)
                                                <option value="{{$product->id}}">{{__($product->name)}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="form-group" id="discount_table">

                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-success"> Save
                                </button>
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
        $(document).ready(function () {
            $('#products').on('change', function () {
                var product_ids = $('#products').val();
                if (product_ids.length > 0) {
                    $.post('{{ route('flash_deals.product_discount') }}', {
                        _token: '{{ csrf_token() }}',
                        product_ids: product_ids
                    }, function (data) {
                        $('#discount_table').html(data);
                        $('.demo-select2').select2();
                    });
                } else {
                    $('#discount_table').html(null);
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush