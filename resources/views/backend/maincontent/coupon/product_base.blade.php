

<?php

$vendors = App\User::with(['roles' => function($q){
            $q->where('name', 'vendor');
        }])->pluck('name', 'id')->toArray();
        
?>

<div class="panel-heading text-center">
    <span class="text-center  p-3 font-12 badge badge-primary mb-3">Add Your Product Base Coupon</h5>
</div>

<div class="row">

    <div class="col-md-6">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-code"></i> &nbsp;Coupon Code</span>
            </div>
            <input type="text" placeholder="Coupon code" id="coupon_code" name="coupon_code" class="form-control" required>
        </div>
    </div>

    
    <div class="product-choose-list col-md-6">
        <div class="product-choose">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-code"></i> &nbsp;Category</span>
                </div>
                <select class="form-control category_id demo-select2" name="category_ids[]" required>
                    @foreach(\App\Category::all() as $key => $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

 
        <div id="subcategory">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-code"></i> &nbsp;Sub-Category</span>
                </div>
                <select class="form-control subcategory_id demo-select2" name="subcategory_ids[]" required>

                </select>
            </div>
        </div>


        <div  id="subsubcategory">
            <div class="input-group mb-3">
                
                <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-code"></i> &nbsp;Sub Sub-Category</span>
                </div>
                <select class="form-control subsubcategory_id demo-select2" name="subsubcategory_ids[]" required>

                </select>
            </div>
        </div>
      
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-product-hunt"></i> &nbsp;Products</span>
                </div>
                <select name="product_ids[]" class="form-control product_id demo-select2" required>

                </select>
            </div>
        </div>
    </div>
   
{{-- <div class="more hide">--}}
{{--    <div class="product-choose">--}}
{{--        <div class="form-group">--}}
{{--            <label class="col-md-6 control-label">Category</label>--}}
{{--            <div class="col-md-6">--}}
{{--                <select class="form-control category_id" name="category_ids[]"--}}
{{--                        onchange="get_subcategories_by_category(this)">--}}
{{--                    @foreach(\App\Category::all() as $key => $category)--}}
{{--                        <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="form-group" id="subcategory">--}}
{{--            <label class="col-md-6 control-label">Subcategory</label>--}}
{{--            <div class="col-md-6">--}}
{{--                <select class="form-control subcategory_id" name="subcategory_ids[]"--}}
{{--                        onchange="get_subsubcategories_by_subcategory(this)">--}}

{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="form-group" id="subsubcategory">--}}
{{--            <label class="col-md-6 control-label">Sub Sub Category</label>--}}
{{--            <div class="col-md-6">--}}
{{--                <select class="form-control subsubcategory_id" name="subsubcategory_ids[]"--}}
{{--                        onchange="get_products_by_subsubcategory(this)">--}}

{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label class="col-md-6 control-label" for="name">Product</label>--}}
{{--            <div class="col-md-6">--}}
{{--                <select name="product_ids[]" class="form-control product_id">--}}
{{-- 
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <hr>--}}
{{--    </div> --}}

{{--<div class="text-right">
    <button class="btn btn-primary" type="button" name="button"
            onclick="appendNewProductChoose()">Add More
    </button>
</div> --}}
<div class="row">
    <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-code"></i> &nbsp;Vendors/Sellers</span>
                </div>
                <select name="vendor"  class="form-control">
                    @foreach ($vendors as $key => $item)
                    <option value="{{$key}}">{{$item}}</option>    
                    @endforeach
                </select>
                <div class="text-center ml-5 mt-2">
                <p class="text-center text-danger bold"><i>Choose specific vendor the coupon will apply to.</i></p></div>
                @if ($errors->has('vendor'))
                    <span class="help-block">
                        {{ $errors->first('vendor') }}
                    </span>
                @endif
            </div>
    </div>
     

    <div class="col-md-6">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-code"></i> &nbsp;Uses Per Coupon<span class="text-danger">*</span></span>
            </div>
        <input type="text" name="uses_per_coupon" class="form-control" placeholder="Enter Uses Value">
        <div class="text-center ml-5 mt-2">
        <p class="text-danger"><i>Maximum number of times a coupon can be used by any customer.</i></p>
        </div>
        @if ($errors->has('uses_per_coupon'))
            <span class="help-block">
                {{ $errors->first('uses_per_coupon') }}
            </span>
        @endif
    </div>
</div>


    
    <div class="col-md-6">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-code"></i> &nbsp;Date</span>
            </div>
        <div id="demo-dp-range">
            <div class="input-daterange input-group" id="datepicker">
                <input type="text" class="form-control" name="start_date">
                <span class="input-group-addon">To</span>
                <input type="text" class="form-control" name="end_date">
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-code"></i> &nbsp;Discount Type</span>
            </div>
        <input type="number" min="0" step="0.01" placeholder="Discount" name="discount" class="form-control"
               required>
        
    <div class="col-md-6">
        <select class="demo-select2" name="discount_type">
            <option value="amount">$</option>
            <option value="percent">%</option>
        </select>
    </div>
</div>
    </div>

<script type="text/javascript">

    function appendNewProductChoose() {
        $('.product-choose-list').append($('.more').html());
        $('.product-choose-list').find('.product-choose').last().find('.category_id').select2();
    }

    function get_subcategories_by_category(el) {
        var category_id = $(el).val();
        console.log(category_id);
        $(el).closest('.product-choose').find('.subcategory_id').html(null);
        $.post('{{ route('subcategories.get_subcategories_by_category') }}', {
            _token: '{{ csrf_token() }}',
            category_id: category_id
        }, function (data) {
            for (var i = 0; i < data.length; i++) {
                $(el).closest('.product-choose').find('.subcategory_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
            }
            $(el).closest('.product-choose').find('.subcategory_id').select2();
            get_subsubcategories_by_subcategory($(el).closest('.product-choose').find('.subcategory_id'));
        });
    }

    function get_subsubcategories_by_subcategory(el) {
        var subcategory_id = $(el).val();
        console.log(subcategory_id);
        $(el).closest('.product-choose').find('.subsubcategory_id').html(null);
        $.post('{{ route('subsubcategories.get_subsubcategories_by_subcategory') }}', {
            _token: '{{ csrf_token() }}',
            subcategory_id: subcategory_id
        }, function (data) {
            for (var i = 0; i < data.length; i++) {
                $(el).closest('.product-choose').find('.subsubcategory_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
            }
            $(el).closest('.product-choose').find('.subsubcategory_id').select2();
            get_products_by_subsubcategory($(el).closest('.product-choose').find('.subsubcategory_id'));
        });
    }

    function get_products_by_subsubcategory(el) {
        var subsubcategory_id = $(el).val();
        console.log(subsubcategory_id);
        $(el).closest('.product-choose').find('.product_id').html(null);
        $.post('{{ route('products.get_products_by_subsubcategory') }}', {
            _token: '{{ csrf_token() }}',
            subsubcategory_id: subsubcategory_id
        }, function (data) {
            for (var i = 0; i < data.length; i++) {
                $(el).closest('.product-choose').find('.product_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
            }
            $(el).closest('.product-choose').find('.product_id').select2();
        });
    }

    $(document).ready(function () {
        $('.demo-select2').select2();
        //get_subcategories_by_category($('.category_id'));
    });

    $('.category_id').on('change', function () {
        get_subcategories_by_category(this);
    });

    $('.subcategory_id').on('change', function () {
        get_subsubcategories_by_subcategory(this);
    });

    $('.subsubcategory_id').on('change', function () {
        get_products_by_subsubcategory(this);
    });


</script>
