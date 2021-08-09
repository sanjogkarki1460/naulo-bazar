@extends('backend.body')
@section('title',  'All-Products')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/nestable/jquery-nestable.css') }}"/>
@endpush
@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Products Section</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Products List</li>
                            </ol>
                        </nav>
                    </div>
                    @if($type != 'Seller')
                        <div class="col-md-6 col-sm-12 text-right hidden-xs">
                            <a href="{{ route('products.create')}}"
                               class="btn btn-rounded btn-info pull-right">Add New Product</a>
                        </div>
                    @endif
                </div>
                <div class="row clearfix">

                    <div class="card">
                        <div class="body">
                            <h3 class="badge badge-primary pull-left pad-no">{{ __($type.' Products') }}</h3>
                            <div class="pull-right clearfix">
                                <form class="" id="sort_products" action="" method="GET">
                                    @if($type == 'Seller')
                                        <div class="box-inline pad-rgt pull-left">
                                            <div class="select" style="min-width: 200px;">
                                                <select class="form-control demo-select2" id="user_id" name="user_id"
                                                        onchange="sort_products()">
                                                    <option value="">All Sellers</option>
                                                    @foreach (App\Seller::all() as $key => $seller)
                                                        @if ($seller->user != null && $seller->user->shop != null)
                                                            <option value="{{ $seller->user->id }}"
                                                                    @if ($seller->user->id == $seller_id) selected @endif>{{ $seller->user->shop->name }}
                                                                ({{ $seller->user->name }})
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="box-inline pad-rgt pull-left">
                                        <div class="select" style="min-width: 200px;">
                                            <select class="form-control demo-select2" name="type" id="type"
                                                    onchange="sort_products()">
                                                <option value="">Sort by</option>
                                                <option value="rating,desc"
                                                        @isset($col_name , $query) @if($col_name == 'rating' && $query == 'desc') selected @endif @endisset>{{__('Rating (High > Low)')}}</option>
                                                <option value="rating,asc"
                                                        @isset($col_name , $query) @if($col_name == 'rating' && $query == 'asc') selected @endif @endisset>{{__('Rating (Low > High)')}}</option>
                                                <option value="num_of_sale,desc"
                                                        @isset($col_name , $query) @if($col_name == 'num_of_sale' && $query == 'desc') selected @endif @endisset>{{__('Num of Sale (High > Low)')}}</option>
                                                <option value="num_of_sale,asc"
                                                        @isset($col_name , $query) @if($col_name == 'num_of_sale' && $query == 'asc') selected @endif @endisset>{{__('Num of Sale (Low > High)')}}</option>
                                                <option value="unit_price,desc"
                                                        @isset($col_name , $query) @if($col_name == 'unit_price' && $query == 'desc') selected @endif @endisset>{{__('Base Price (High > Low)')}}</option>
                                                <option value="unit_price,asc"
                                                        @isset($col_name , $query) @if($col_name == 'unit_price' && $query == 'asc') selected @endif @endisset>{{__('Base Price (Low > High)')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box-inline pad-rgt pull-left">
                                        <div class="" style="min-width: 200px;">
                                            <input type="text" class="form-control" id="search" name="search"
                                                   @isset($sort_search) value="{{ $sort_search }}"
                                                   @endisset placeholder="Type & Enter">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table class="table header-border table-hover  spacing5">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th width="20%">Name</th>
                                        @if($type == 'vendor')
                                            <th>Seller Name</th>
                                        @endif
                                        <th>Num of Sale</th>
                                        <th>Total Stock</th>
                                        <th>Base Price</th>
                                        <th>Todays Deal</th>
                                        <th>Rating</th>
                                        <th>Published</th>
                                        <th>Featured</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $key => $product)
                                        <tr>
                                            <td>{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage() }}</td>
                                            <td>
                                                <a href=""
                                                   target="_blank"
                                                   class="media-block">
                                                    <div class="media-left">
                                                        <img loading="lazy" class="img-md"
                                                             src="{{ asset($product->thumbnail_img)}}"
                                                             alt="Image">
                                                    </div>
                                                    <div class="media-body">{{ __($product->name) }}</div>
                                                </a>
                                            </td>
                                            @if($type == 'vendor')
                                                <td>{{ $product->user->name }}</td>
                                            @endif
                                            <td>{{ $product->num_of_sale }} times</td>
                                            <td>
                                                @php
                                                    $qty = 0;
                                                    if($product->variant_product){
                                                        foreach ($product->stocks as $key => $stock) {
                                                            $qty += $stock->qty;
                                                        }
                                                    }
                                                    else{
                                                        $qty = $product->current_stock;
                                                    }
                                                    echo $qty;
                                                @endphp
                                            </td>
                                            <td>{{ number_format($product->unit_price,2) }}</td>
                                            <td><label class="switch">
                                                    <input onchange="update_todays_deal(this)"
                                                           type="checkbox"
                                                           value="{{ $product->id }}" <?php if ($product->todays_deal == 1) echo "checked";?> >
                                                    <span class="slider round"></span></label></td>
                                            <td>{{ $product->rating }}</td>
                                            <td><label class="switch">
                                                    <input onchange="update_published(this)"
                                                           value="{{ $product->id }}"
                                                           type="checkbox" <?php if ($product->published == 1) echo "checked";?> >
                                                    <span class="slider round"></span></label></td>
                                            <td><label class="switch">
                                                    <input onchange="update_featured(this)"
                                                           value="{{ $product->id }}"
                                                           type="checkbox" <?php if ($product->featured == 1) echo "checked";?> >
                                                    <span class="slider round"></span></label></td>
                                            <td>
                                                <div class="btn-group dropdown">
                                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon"
                                                            data-toggle="dropdown" type="button">
                                                        Actions <i class="dropdown-caret"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        @if ($type == 'vendor')
                                                            <li>
                                                                <a href="{{route('products.seller.edit', encrypt($product->id))}}">Edit</a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="{{route('products.admin.edit', encrypt($product->id))}}">Edit</a>
                                                            </li>
                                                        @endif
                                                        <li>
                                                            <a onclick="confirm_modal('{{route('products.destroy', $product->id)}}')">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="clearfix">
                                    <div class="pull-right">
                                        {{ $products->appends(request()->input())->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">

                        <h4 class="modal-title" id="myModalLabel"><?php echo e(__('Confirmation')); ?></h4>
                    </div>

                    <div class="modal-body">
                        <p>Are You Sure You Want To Delete This Product</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                        <a id="delete_link" class="btn btn-danger btn-ok"><?php echo e(__('Delete')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">

            function update_todays_deal(el) {
                if (el.checked) {
                    var status = 1;
                } else {
                    var status = 0;
                }
                $.post('{{ route('products.todays_deal') }}', {
                    _token: '{{ csrf_token() }}',
                    id: el.value,
                    status: status
                }, function (data) {
                    if (data == 1) {
                        showAlert('success', 'Todays Deal updated successfully');
                    } else {
                        showAlert('danger', 'Something went wrong');
                    }
                });
            }

            function update_published(el) {
                if (el.checked) {
                    var status = 1;
                } else {
                    var status = 0;
                }
                $.post('{{ route('products.published') }}', {
                    _token: '{{ csrf_token() }}',
                    id: el.value,
                    status: status
                }, function (data) {
                    if (data == 1) {
                        showAlert('success', 'Published products updated successfully');
                    } else {
                        showAlert('danger', 'Something went wrong');
                    }
                });
            }

            function update_featured(el) {
                if (el.checked) {
                    var status = 1;
                } else {
                    var status = 0;
                }
                $.post('{{ route('products.featured') }}', {
                    _token: '{{ csrf_token() }}',
                    id: el.value,
                    status: status
                }, function (data) {
                    if (data == 1) {
                        showAlert('success', 'Featured products updated successfully');
                    } else {
                        showAlert('danger', 'Something went wrong');
                    }
                });
            }

            function confirm_modal(delete_url) {
                jQuery('#confirm-delete').modal('show', {backdrop: 'static'});
                document.getElementById('delete_link').setAttribute('href', delete_url);
            }


            function sort_products(el) {
                $('#sort_products').submit();
            }
</script>
@endpush
