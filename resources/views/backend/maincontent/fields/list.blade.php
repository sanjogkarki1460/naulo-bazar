@extends('backend.body')
@section('title',  'Fields')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/nestable/jquery-nestable.css') }}" />
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
                            href="#Pages">{{ isset($market) ? $market->title : 'Fields' }}</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ $id != 0 ? 'show active' : '' }}" data-toggle="tab"
                            href="#addPage">{{ $id == 0 ? 'Add Attributes' : 'Update Fields' }}</a>
                    </li>
                </ul>
                <div class="tab-content mt-0">
                    @if($id == 0)
                    <div class="tab-pane show active" id="Pages">
                        <div class="card">
                            <div class="header card-header">
                                <h6 class="title mb-0">All Fields</h6>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Category  </th>
                                                <th>Value</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!$fields->isEmpty())

                                            @foreach($fields as $field)
                                            @php

                                                $attributes = json_decode($field->title);
                                            @endphp
                                            <tr class="text-center">
                                                <td>{{$loop->index+1}}</td>
                                                <td>
                                                    <div class="font-15">{{ucfirst($field->category->title)}}</div>
                                                </td>
                                               <td>{{ str_replace( array("]","[","" ),'',$field->title )}}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-default" title="View"
                                                        data-toggle="modal"
                                                        onclick=""><i
                                                            class="fa fa-eye"></i>
                                                    </a>
                                                    <a href=""
                                                        class="btn btn-sm btn-default"><i
                                                            class="fa fa-edit text-info"></i></a>
                                                    <form id="deleteContact"
                                                        action=""
                                                        method="Post" style="display: inline">
                                                        @csrf
                                                        <a href="{{ route('variations.delete',$field->id) }}" id="contactDelete"
                                                            class="btn btn-sm btn-default js-sweetalert" title="Delete"
                                                            data-type="confirm"><i
                                                                class="fa fa-trash-o text-danger"></i></a>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    {{-- {{$products->links()}} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
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
                    <div class="tab-pane {{ $id != 0 ? 'show active' : '' }}" id="addPage">
                        <div class="card">
                            <div class="header card-header">
                                <h6 class="title mb-0">{{ isset($market) ? $market->name : 'Add Attributes' }}</h6>
                            </div>
                            <div class="body mt-2">
                                <form method="post"
                                    action="{{ route('variations.store')  }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="productId" name="id" value="{{ $id != 0 ? $id : '' }}" />
                                    <div class="card">
                                        <div class="row clearfix">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header ">
                                                        Select Category
                                                    </div>
                                                    <div class="body">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <label for="">Select Category</label>
                                                                <select name="category_id" id="" class="form-control">
                                                                    @foreach($categories as $category)
                                                                         <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row"></div>
                                                    </div>

                                                </div>
                                                <br>
                                                <div class="card">
                                                    <div class="card-header ">
                                                        Add Attrubutes
                                                    </div>
                                                    <div class="body">
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <a onclick="" id="text_box"  class="btn btn-outline-success">Size</a>
                                                                <input type="checkbox" name="title[]" value="Size" checked>

                                                            </div>
                                                            <div class="col-2">
                                                                <a onclick="" id="text_box"  class="btn btn-outline-success">Color</a>
                                                                <input type="checkbox" name="title[]" value="Color" checked>

                                                            </div>
                                                            <div class="col-2">
                                                                <a onclick="" id="text_box"  class="btn btn-outline-success">Storage</a>
                                                                <input type="checkbox" name="title[]" value="Storage" checked>

                                                            </div>
                                                            <div class="col-2">
                                                                <a onclick="" id="text_box"  class="btn btn-outline-success">Ram</a>
                                                                <input type="checkbox" name="title[]" value="Ram" checked>
                                                            </div>

                                                            <div class="col-2">
                                                                <a onclick="appenddToForm('text')" id="text_box"  class="btn btn-outline-success">Add More</a>
                                                            </div>


                                                        </div>
                                                        <div class="row"></div>
                                                    </div>

                                                </div>
                                                <br>

                                                {{-- <div class="card" id="optional">

                                                    </div> --}}
                                            </div>

                                            {{-- <a href="#" id="option" class="btn-btn info badge-info">Add Option</a> --}}
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header ">
                                                        Field Title, Type & Value
                                                    </div>
                                                    <div class="body">
                                                        <div id="result">
                                                            <div class="row">

                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                <br>

                                                {{-- <div class="card" id="optional">

                                                    </div> --}}
                                            </div>

                                            {{-- <a href="#" id="option" class="btn-btn info badge-info">Add Option</a> --}}
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-md-12">
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

<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
                    </div>@push('styles')
                    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/nestable/jquery-nestable.css') }}" />


                    @endpush
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
<script type="text/javascript">

    var i = 0;
    function delete_choice_clearfix(em)
    {
			$(em).parent().parent().remove();
	}
    function add_customer_choice_options(em)
    {
        var j = $(em).closest('.input-group ').find('.option').val();
        var str = ' <div class="input-group mb-3">'
                             +'<div class="col-lg-3">'
                                +'<label class="control-label">Option</label>'
                            +'</div>'
                        +'<div class="col-sm-6 col-sm-offset-4">'
                            +'<input class="form-control" type="text" name="options_'+j+'[]" value="" required>'
                        +'</div>'
                        +'<div class="col-sm-2"> <span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                        +'</div>'
                        +'</div>'

                    +'</div>'
        $(em).parent().find('.customer_choice_options_types_wrap_child').append(str);
    }
    function delete_choice_clearfix(em){
        $(em).parent().parent().remove();
    }
    function appenddToForm(type){
        //$('#form').removeClass('seller_form_border');
        if(type == 'text'){
            var str = '<div class="col-md-6">'
                            +' <div class="input-group mb-3">'
                            +' <div class="input-group-prepend">'
                                +'<span class="input-group-text">'
                            +'<i class="fa fa-dollar">'
                            +'</i>'
                                +' &nbsp;Add Attributes</span>'
                            +'</div>'
                            +'<input class="form-control" type="text" name="title[]" placeholder="Label">'
                            +'<div class="col-lg-2">'
									+'<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
								+'</div>'
                                +'</div>'

                            +'</div>';

            $('#result').append(str);
        }
        else if (type == 'checkbox') {
            i++;
            var str = '<div class="col-md-6">'
                            +'  <div class="input-group mb-3">'
                            +' <div class="input-group-prepend">'
                                +'<span class="input-group-text">'
                            +'<i class="fa fa-dollar">'
                            +'</i>'
                                +' &nbsp;CheckBox</span>'
                                +' <input type="text" name="checkbox[]" class="form-control">'
                                +' <div class="input-group-text">'
                            +' <input type="checkbox" name="" value="1" checked>'

                            +'</div>'

                            +'<div class="col-lg-2">'
                                +'<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                            +'</div>'
                        +'</div>'+'</div>'+'</div>';
            $('#result').append(str);
        }
        else if (type == 'multi-select') {
            i++;
            var str = '<div class="col-md-6">'
                            +'<div class="input-group mb-3">'
                            +'<input type="hidden" name="select[]" value="multi_select"><input type="hidden" name="option[]" class="option" value="'+i+'">'
                            +'<div class="col-lg-3">'
                                +'<label class="control-label">Multiple select</label>'
                            +'</div>'
                            +'<div class="col-lg-7">'
                                +'<input class="form-control" type="text" name="select[]" placeholder="Multiple Select Label" style="margin-bottom:10px">'
                                +'<div class="customer_choice_options_types_wrap_child">'
                                +'</div>'
                                +'<button class="btn btn-success pull-right" type="button" onclick="add_customer_choice_options(this)"><i class="glyphicon glyphicon-plus"></i> Add option</button>'
                            +'</div>'
                            +'<div class="col-lg-2">'
                                +'<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                            +'</div>'

                        +'</div>';
            $('#result').append(str);
        }
        else if (type == 'description') {
            i++;
            var str = '<div class="col-md-12">'
                            +' <div class="input-group mb-3">'
                            +' <div class="input-group-prepend">'
                                +'<span class="input-group-text">'
                            +'<i class="fa fa-file-text-o">'
                            +'</i>'
                                +' &nbsp;Text</span>'
                            +'</div>'
                            +' <textarea class="form-control summernote" name="short_content"></textarea>'
                            +'<div class="col-lg-2">'
									+'<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
								+'</div>'
                                +'</div>'

                            +'</div>';

            $('#result').append(str);
        }
        else if (type == 'file') {
            var str =
            ' <div class="col-md-4"><div class="card">'
                            +' <div class="card-header">'
                                +'  <i class="fa fa-image"></i> &nbsp; Featured Image'
                            +'</div>'
                            +'<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)" style="float: right;z-index: 7;position: relative;"></span>'
                            +' <div class="alert alert-success border-success">'
                                +'<input type="file" name="image" class="dropify bg-primary form-control">'

                            +'</div>'
                            +'</div>'
                                +'</div>'
                            +'</div>'+
                    ' <div class="col-md-8"><div class="card">'
                            +' <div class="card-header">'
                                +'  <i class="fa fa-image"></i> &nbsp; Featured Image'

                            +'</div>'
                            +'<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)" style="float: right;z-index: 7;position: relative;"></span>'
                            +' <div class="alert alert-success border-success">'
                                +'<input type="file" class="dropify bg-info form-control" name="other_images[]" multiple>'
                            +'</div>'
                            +'</div>'
                                +'</div>'
            $('#result').append(str);
        }
    }
</script>
<script src="{{ asset('backend/assets/vendor/nestable/jquery.nestable.js') }}"></script><!-- Jquery Nestable -->
@endpush
