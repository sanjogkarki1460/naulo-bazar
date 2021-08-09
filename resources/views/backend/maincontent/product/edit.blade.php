@extends('backend.body')
@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Edit Product</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Products</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Products</li>
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
                    <form class="form form-horizontal mar-top" action="{{route('products.update', $product->id)}}"
                          method="POST" enctype="multipart/form-data" id="choice_form">
                        @csrf
                        <input name="_method" type="hidden" value="POST">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="body mt-2">
                            <div class="header">
                                <h2 class="badge badge-primary">Product Information</h2>
                                <hr class="bg-blue">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Product Name</span>
                                        </div>
                                        <input type="text" class="form-control" name="name"
                                               placeholder="{{__('Product Name')}}" value="{{$product->name}}" required>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Category</span>
                                        </div>
                                        <select class="form-control demo-select2-placeholder"
                                                name="category_id"
                                                id="category_id" required>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" <?php if ($product->category_id == $category->id) echo "selected"; ?>>{{__($category->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" id="subcategory">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Sub-Category</span>
                                        </div>
                                        <select class="form-control demo-select2-placeholder"
                                                name="subcategory_id"
                                                id="subcategory_id" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" id="subsubcategory">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Sub-Sub-Category</span>
                                        </div>
                                        <select class="form-control demo-select2-placeholder"
                                                name="subsubcategory_id"
                                                id="subsubcategory_id" disabled>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" id="brand">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Brand</span>
                                        </div>
                                        <select class="form-control demo-select2-placeholder"
                                                name="brand_id"
                                                id="brand_id">
                                            <option value="">{{ ('Select Brand') }}</option>
                                            @foreach (\App\Brand::all() as $brand)
                                                <option value="{{ $brand->id }}"
                                                        @if($product->brand_id == $brand->id) selected @endif>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Unit</span>
                                        </div>
                                        <input type="text" class="form-control" name="unit"
                                               placeholder="Unit (e.g. KG, Pc etc)" value="{{$product->unit}}" required>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Tags</span>
                                        </div>
                                        <input type="text" class="form-control" name="tags[]" id="tags"
                                               value="{{ $product->tags }}" placeholder="Type to add a tag"
                                               data-role="tagsinput">

                                    </div>
                                </div>
                            </div>
                            <hr class="bg-info">
                            <div class="body mt-2">
                                <div class="header">
                                    <h2 class="badge badge-primary">Product Images & Videos</h2>
                                    <hr class="bg-blue">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Thumbnail Image</span>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="thumbnail_img">
                                                    @if ($product->thumbnail_img != null)
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <div class="img-upload-preview">
                                                                <img loading="lazy"
                                                                     src="{{ asset($product->thumbnail_img) }}" alt=""
                                                                     class="img-responsive">
                                                                <input type="hidden" name="previous_thumbnail_img"
                                                                       value="{{ $product->thumbnail_img }}">
                                                                <button type="button"
                                                                        class="btn btn-danger close-btn remove-files"><i
                                                                            class="fa fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Gallery Images</span>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="photos">
                                                    @if(is_array(json_decode($product->photos)))
                                                        @foreach (json_decode($product->photos) as $key => $photo)
                                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                                <div class="img-upload-preview">
                                                                    <img loading="lazy" src="{{ asset($photo) }}" alt=""
                                                                         class="img-responsive">
                                                                    <input type="hidden" name="previous_photos[]"
                                                                           value="{{ $photo }}">
                                                                    <button type="button"
                                                                            class="btn btn-danger close-btn remove-files">
                                                                        <i class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Featured Images</span>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="featured_img">
                                                    @if ($product->featured_img != null)
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <div class="img-upload-preview">
                                                                <img loading="lazy"
                                                                     src="{{ asset($product->featured_img) }}" alt=""
                                                                     class="img-responsive">
                                                                <input type="hidden" name="previous_featured_img"
                                                                       value="{{ $product->featured_img }}">
                                                                <button type="button"
                                                                        class="btn btn-danger close-btn remove-files"><i
                                                                            class="fa fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width pl-3"></i> &nbsp;Flash Image</span>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="flash_deal_img">
                                                    @if($product->flash_deal_img != null)
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <div class="img-upload-preview">
                                                                <img loading="lazy"
                                                                     src="{{ asset($product->flash_deal_img) }}" alt=""
                                                                     class="img-responsive">
                                                                <input type="hidden" name="previous_flash_deal_img"
                                                                       value="{{ $product->flash_deal_img }}">
                                                                <button type="button"
                                                                        class="btn btn-danger close-btn remove-files"><i
                                                                            class="fa fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="bg-info">

                            <div class="body mt-2">
                                <div class="header">
                                    <h2 class="badge badge-primary">Product Variation</h2>
                                    <hr class="bg-blue">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Colors</span>
                                            </div>
                                            <select class="form-control color-var-select" name="colors[]" id="colors"
                                                    multiple disabled>
                                                <option value="#">Choose Color</option>
                                                @foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)

                                                    <option value="{{ $color->code }}" <?php if (in_array($color->code, json_decode($product->colors))) echo 'selected'?> >{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="switch" style="margin-top:5px;">
                                                <input value="1" type="checkbox"
                                                       name="colors_active" <?php if (count(json_decode($product->colors)) > 0) echo "checked";?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Attributes</span>
                                            </div>
                                            <select name="choice_attributes[]" id="choice_attributes"
                                                    class="form-control demo-select2" multiple
                                                    data-placeholder="Choose Attributes">
                                                <option value="#">Select Attributes</option>
                                                @foreach (\App\Attribute::all() as $key => $attribute)
                                                    <option value="{{ $attribute->id }}"
                                                            @if($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))) selected @endif>{{ $attribute->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div>
                                        <p class="badge-danger">Choose the attributes of this product and
                                            then input
                                            values of each
                                            attribute</p>
                                        <br>
                                    </div>
                                </div>


                                <div class="row customer_choice_options" id="customer_choice_options">
                                    @foreach (json_decode($product->choice_options) as $key => $choice_option)
                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <input type="hidden" name="choice_no[]"
                                                       value="{{ $choice_option->attribute_id }}">
                                                <input type="text" class="form-control" name="choice[]"
                                                       value="{{ \App\Attribute::find($choice_option->attribute_id)->name }}"
                                                       placeholder="Choice Title" disabled>
                                            </div>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control"
                                                       name="choice_options_{{ $choice_option->attribute_id }}[]"
                                                       placeholder="Enter choice values"
                                                       value="{{ implode(',', $choice_option->values) }}"
                                                       data-role="tagsinput" onchange="update_sku()">
                                            </div>
                                            <div class="col-lg-2">
                                                <button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i
                                                            class="demo-psi-recycling icon-lg"></i></button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            <hr class="bg-info">
                            <div class="body mt-2">
                                <div class="header">
                                    <h2 class="badge badge-primary">Product Price & Stock</h2>
                                    <hr class="bg-blue">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Unit Price</span>
                                            </div>
                                            <input type="text" placeholder="{{__('Unit price')}}" name="unit_price"
                                                   class="form-control" value="{{$product->unit_price}}" required>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Purchase Price</span>
                                            </div>
                                            <input type="number" min="0" step="0.01"
                                                   placeholder="{{__('Purchase price')}}" name="purchase_price"
                                                   class="form-control" value="{{$product->purchase_price}}" required>

                                        </div>
                                    </div>

                                    <div class="d-flex col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Tax</span>
                                            </div>
                                            <input type="number" min="0" step="0.01" placeholder="{{__('tax')}}"
                                                   name="tax" class="form-control" value="{{$product->tax}}" required>

                                        </div>

                                        <select class="demo-select2 form-control" name="tax_type">
                                            <option value="amount" <?php if ($product->tax_type == 'amount') echo "selected";?> >{{__('Flat')}}</option>
                                            <option value="percent" <?php if ($product->tax_type == 'percent') echo "selected";?> >{{__('Percent')}}</option>

                                        </select>
                                    </div>

                                    <div class="d-flex col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Discount</span>
                                            </div>
                                            <input type="number" min="0" value="0" step="0.01"
                                                   placeholder="{{__('Discount')}}"
                                                   name="discount" class="form-control" required>
                                        </div>

                                        <select class="demo-select2 form-control" name="discount_type">
                                            <option value="amount" <?php if ($product->discount_type == 'amount') echo "selected";?> >{{__('Flat')}}</option>
                                            <option value="percent" <?php if ($product->discount_type == 'percent') echo "selected";?> >{{__('Percent')}}</option>

                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Quantity</span>
                                            </div>
                                            <input type="number" min="0" value="{{ $product->current_stock }}" step="1"
                                                   placeholder="{{__('Quantity')}}" name="current_stock"
                                                   class="form-control" required>

                                            <div>
                                            </div>

                                            <br>
                                            <div class="sku_combination" id="sku_combination">

                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>



                                    <hr class="bg-info">

                                    <div class="row">
                                        @php
                                            $pos_addon = \App\Addon::where('unique_identifier', 'pos_system')->first();
                                        @endphp

                                        @if ($pos_addon != null && $pos_addon->activated == 1)
                                            <div class="col-md-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Barcode</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="barcode"
                                                           placeholder="{{ ('Barcode') }}" value="{{ $product->barcode }}">
                                                </div>
                                            </div>
                                        @endif



                                        @php
                                            $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                                        @endphp
                                        @if ($refund_request_addon != null && $refund_request_addon->activated == 1)


                                            <div class="col-md-6">

                                                <div class="input-group-prepend">
                                                    <label class="input-group-text font-weight-bold" id="">
                                                        &nbsp;Refundable</label>

                                                    <div class="text-right pt-2 pl-5">
                                                        <label class="switch">
                                                            <input type="checkbox" name="refundable" @if ($product->refundable == 1) checked @endif>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>



                                {{--        <div class="panel">--}}
                                {{--            <div class="panel-heading bord-btm">--}}
                                {{--                <h3 class="panel-title">{{__('Product Videos')}}</h3>--}}
                                {{--            </div>--}}
                                {{--            <div class="panel-body">--}}
                                {{--                <div class="form-group">--}}
                                {{--                    <label class="col-lg-2 control-label">{{__('Video Provider')}}</label>--}}
                                {{--                    <div class="col-lg-7">--}}
                                {{--                        <select class="form-control demo-select2-placeholder"--}}
                                {{--                                name="video_provider"--}}
                                {{--                                id="video_provider">--}}
                                {{--                            <option value="youtube">{{__('Youtube')}}</option>--}}
                                {{--                            <option value="dailymotion">{{__('Dailymotion')}}</option>--}}
                                {{--                            <option value="vimeo">{{__('Vimeo')}}</option>--}}
                                {{--                        </select>--}}
                                {{--                    </div>--}}
                                {{--                </div>--}}
                                {{--                <div class="form-group">--}}
                                {{--                    <label class="col-lg-2 control-label">{{__('Video Link')}}</label>--}}
                                {{--                    <div class="col-lg-7">--}}
                                {{--                        <input type="text" class="form-control" name="video_link"--}}
                                {{--                               placeholder="{{__('Video Link')}}">--}}
                                {{--                    </div>--}}
                                {{--                </div>--}}
                                {{--            </div>--}}
                                {{--        </div>--}}

                                <div class="body mt-2">
                                    <div class="header">
                                        <h2 class="badge badge-primary">Product Description</h2>
                                        <hr class="bg-blue">
                                    </div>

                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                        class="fa fa-file-text-o fa-lg"></i>&nbsp; Product Description</span>
                                            </div>
                                            <textarea class="form-control summernote" name="description"
                                                      aria-label="Default">{!!isset($product->description) ? $product->description : ''!!}</textarea>

                                        </div>
                                    </div>
                                </div>


                                <hr class="bg-info">

                                <div class="body mt-2">
                                    <div class="header">
                                        <h2 class="badge badge-primary">Other's</h2>
                                        <h6 class="badge badge-primary pull-right">SEO Meta Tags</h6>
                                        <hr class="bg-blue">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;PDF</span>
                                                </div>
                                                <input type="file" class="form-control" placeholder="{{__('PDF')}}"
                                                       name="pdf" accept="application/pdf">
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Meta Title</span>
                                                </div>
                                                <input type="text" class="form-control" name="meta_title"
                                                       value="{{ $product->meta_title }}"
                                                       placeholder="{{__('Meta Title')}}">

                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Description</span>
                                                </div>
                                                <textarea class="form-control summernote" name="description"
                                                          aria-label="Default">{!! isset($product->meta_description) ? $product->meta_description : '' !!}</textarea>

                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width pl-3"></i> &nbsp;Image</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div id="meta_photo">
                                                        @if ($product->meta_img != null)
                                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                                <div class="img-upload-preview">
                                                                    <img loading="lazy"
                                                                         src="{{ asset($product->meta_img) }}"
                                                                         alt="" class="img-responsive">
                                                                    <input type="hidden" name="previous_meta_img"
                                                                           value="{{ $product->meta_img }}">
                                                                    <button type="button"
                                                                            class="btn btn-danger close-btn remove-files">
                                                                        <i class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <br>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-outline-secondary bage badge-danger">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>




    {{--                @if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'product_wise_shipping')--}}
    {{--                    <div class="panel">--}}
    {{--                        <div class="panel-heading bord-btm">--}}
    {{--                            <h3 class="panel-title">{{__('Product Shipping Cost')}}</h3>--}}
    {{--                        </div>--}}
    {{--                        <div class="panel-body">--}}
    {{--                            <div class="row bord-btm">--}}
    {{--                                <div class="col-md-2">--}}
    {{--                                    <div class="panel-heading">--}}
    {{--                                        <h3 class="panel-title">{{__('Free Shipping')}}</h3>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-10">--}}
    {{--                                    <div class="form-group">--}}
    {{--                                        <label class="col-lg-2 control-label">{{__('Status')}}</label>--}}
    {{--                                        <div class="col-lg-7">--}}
    {{--                                            <label class="switch" style="margin-top:5px;">--}}
    {{--                                                <input type="radio" name="shipping_type" value="free" checked>--}}
    {{--                                                <span class="slider round"></span>--}}
    {{--                                            </label>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            <div class="row">--}}
    {{--                                <div class="col-md-2">--}}
    {{--                                    <div class="panel-heading">--}}
    {{--                                        <h3 class="panel-title">{{__('Flat Rate')}}</h3>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-10">--}}
    {{--                                    <div class="form-group">--}}
    {{--                                        <label class="col-lg-2 control-label">{{__('Status')}}</label>--}}
    {{--                                        <div class="col-lg-7">--}}
    {{--                                            <label class="switch" style="margin-top:5px;">--}}
    {{--                                                <input type="radio" name="shipping_type" value="flat_rate" checked>--}}
    {{--                                                <span class="slider round"></span>--}}
    {{--                                            </label>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="form-group">--}}
    {{--                                        <label class="col-lg-2 control-label">{{__('Shipping cost')}}</label>--}}
    {{--                                        <div class="col-lg-7">--}}
    {{--                                            <input type="number" min="0" value="0" step="0.01"--}}
    {{--                                                   placeholder="{{__('Shipping cost')}}" name="flat_shipping_cost"--}}
    {{--                                                   class="form-control" required>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                @endif--}}

@endsection

@push('scripts')

    <script type="text/javascript">
        function add_more_customer_choice_option(i, name) {
            $('#customer_choice_options').append('<div class="col-md-6"><div class="input-group mb-3"><div class="input-group-prepend">' +
                '   <span class="input-group-text" id="inputGroup-sizing-default"><i\n' +
                '                                                            class="fa fa-text-width"></i> &nbsp;' + name + '</span>' +
                '<input type="hidden" name="choice_no[]" value="' + i + '">' +
                '<input type="hidden" class="form-control" name="choice[]" value="' + name + '" placeholder="Choice Title" readonly></div>' +
                '<input type="text" class="form-control" name="choice_options_' + i +
                '[]" placeholder="Enter choice values" ' +
                'data-role="tagsinput" onchange="update_sku()"></div></div>');

            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        $('input[name="colors_active"]').on('change', function () {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors').prop('disabled', true);
            } else {
                $('#colors').prop('disabled', false);
            }
            update_sku();
        });

        $('#colors').on('change', function () {
            update_sku();
        });

        $('input[name="unit_price"]').on('keyup', function () {
            update_sku();
        });

        $('input[name="name"]').on('keyup', function () {
            update_sku();
        });

        function delete_row(em) {
            $(em).closest('.form-group').remove();
            update_sku();
        }

        function update_sku() {
            $.ajax({
                type: "POST",
                url: '',
                data: $('#choice_form').serialize(),
                success: function (data) {
                    $('#sku_combination').html(data);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }

        function get_subcategories_by_category() {
            var category_id = $('#category_id').val();
            $.post(' {{route('subcategories.get_subcategories_by_category')}}', {
                _token: '{{ csrf_token() }}',
                category_id: category_id
            }, function (data) {
                $('#subcategory_id').html(null);
                if (data.length > 0) {
                    $('#subcategory_id').removeAttr('disabled');
                    $('#subsubcategory_id').removeAttr('disabled');
                    for (var i = 0; i < data.length; i++) {
                        $('#subcategory_id').append($('<option>', {
                            value: data[i].id,
                            text: data[i].name
                        }));
                        $('.demo-select2').select2();
                    }

                } else {
                    $('#subcategory_id').append($('<option>', {
                        value: "#",
                        text: 'No Sub-Category',
                    }));
                    $('#subcategory_id').prop('disabled', true)
                }
                get_subsubcategories_by_subcategory();
            });
        }

        function get_subsubcategories_by_subcategory() {
            var subcategory_id = $('#subcategory_id').val();
            $.post('{{ route('subsubcategories.get_subsubcategories_by_subcategory') }}', {
                _token: '{{ csrf_token() }}',
                subcategory_id: subcategory_id
            }, function (data) {
                $('#subsubcategory_id').html(null);
                $('#subsubcategory_id').append($('<option>', {
                    value: null,
                    text: null,
                }));
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        $('#subsubcategory_id').append($('<option>', {
                            value: data[i].id,
                            text: data[i].name
                        }));
                        $('.demo-select2').select2();
                    }
                }
                //get_brands_by_subsubcategory();
            });
        }

        function get_brands_by_subsubcategory() {
            var subsubcategory_id = $('#subsubcategory_id').val();
            $.post('{', {
                _token: '{{ csrf_token() }}',
                subsubcategory_id: subsubcategory_id
            }, function (data) {
                $('#brand_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#brand_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                    $('.demo-select2').select2();
                }
            });
        }

        function get_attributes_by_subsubcategory() {
            var subsubcategory_id = $('#subsubcategory_id').val();
            $.post('', {
                _token: '{{ csrf_token() }}',
                subsubcategory_id: subsubcategory_id
            }, function (data) {
                $('#choice_attributes').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#choice_attributes').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $('.demo-select2').select2();
            });
        }

        $(document).ready(function () {
            get_subcategories_by_category();
            $("#photos").spartanMultiImagePicker({
                fieldName: 'photos[]',
                maxCount: 10,
                rowHeight: '150px',
                groupClassName: 'col-md-12 col-sm-6 col-xs-6',
                maxFileSize: '',
                dropFileLabel: "Drop Here",
                onExtensionErr: function (index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    console.log(index, file, 'file size too big');
                    alert('File size too big');
                }
            });
            $("#thumbnail_img").spartanMultiImagePicker({
                fieldName: 'thumbnail_img',
                maxCount: 1,
                rowHeight: '150px',
                groupClassName: 'col-md-12 col-sm-6 col-xs-6',
                maxFileSize: '',
                dropFileLabel: "Drop Here",
                onExtensionErr: function (index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    console.log(index, file, 'file size too big');
                    alert('File size too big');
                }
            });
            $("#featured_img").spartanMultiImagePicker({
                fieldName: 'featured_img',
                maxCount: 1,
                rowHeight: '150px',
                groupClassName: 'col-md-12 col-sm-6 col-xs-6',
                maxFileSize: '',
                dropFileLabel: "Drop Here",
                onExtensionErr: function (index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    console.log(index, file, 'file size too big');
                    alert('File size too big');
                }
            });
            $("#flash_deal_img").spartanMultiImagePicker({
                fieldName: 'flash_deal_img',
                maxCount: 1,
                rowHeight: '150px',
                groupClassName: 'col-md-12 col-sm-6 col-xs-6',
                maxFileSize: '',
                dropFileLabel: "Drop Here",
                onExtensionErr: function (index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    console.log(index, file, 'file size too big');
                    alert('File size too big');
                }
            });
            $("#meta_photo").spartanMultiImagePicker({
                fieldName: 'meta_img',
                maxCount: 1,
                rowHeight: '150px',
                groupClassName: 'col-md-12 col-sm-6 col-xs-6',
                maxFileSize: '',
                dropFileLabel: "Drop Here",
                onExtensionErr: function (index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    console.log(index, file, 'file size too big');
                    alert('File size too big');
                }
            });
        });

        $('#category_id').on('change', function () {
            get_subcategories_by_category();
        });

        $('#subcategory_id').on('change', function () {
            get_subsubcategories_by_subcategory();
        });

        $('#subsubcategory_id').on('change', function () {
            // get_brands_by_subsubcategory();
            //get_attributes_by_subsubcategory();
        });

        $('#choice_attributes').on('change', function () {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function () {
                //console.log($(this).val());
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
            update_sku();
        });


    </script>

@endpush
