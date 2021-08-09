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
                            href="#Pages">{{ isset($market) ? $market->title : 'Product Setting' }}</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ $id != 0 ? 'show active' : '' }}" data-toggle="tab"
                            href="#addPage">{{ $id == 0 ? 'Add Commission' : 'Update Fields' }}</a>
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
                                                <th>Admin Commission</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!$admin_commissions->isEmpty())

                                            @foreach($admin_commissions as $admin_commission)
                                            <tr class="text-center">
                                                <td>{{$loop->index+1}}</td>
                                                <td>
                                                    <div class="font-15">{{ucfirst($admin_commission->category->title)}}</div>
                                                </td>
                                               <td>{{ $admin_commission->admin_commisson }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-default" title="View"
                                                        data-toggle="modal"
                                                        onclick=""><i
                                                            class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{route('product.setting.edit',$admin_commission->id)}}"
                                                        class="btn btn-sm btn-default"><i
                                                            class="fa fa-edit text-info"></i></a>
                                                    <form id="deleteContact"
                                                        action=""
                                                        method="post" style="display: inline">
                                                        @csrf
                                                        <a href="{{ route('variations.delete',$admin_commission->id) }}" id="contactDelete"
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
                                <h6 class="title mb-0">{{ isset($market) ? $market->name : 'Add Commission' }}</h6>
                            </div>
                            <div class="body mt-2">
                                <form method="post"
                                    action=" {{ isset($commission) ? route('product.setting.update',$commission->id) :  route('product.setting.store')  }} "
                                    enctype="multipart/form-data">
                                    @csrf
                                    @if($id != 0 )
                                    @method('put')
                                    @endif
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
                                                        Add Commission
                                                    </div>
                                                    <div class="body">
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <input type="number" name="admin_commisson" value="{{isset($commission) ? $commission->admin_commisson : null}}" checked>
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

