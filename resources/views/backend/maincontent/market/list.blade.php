@extends('backend.body')
@section('title', isset($market) ? $market->name : 'Shops')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/nestable/jquery-nestable.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/summernote/dist/summernote.css') }}" />

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
                                href="#Pages">{{ isset($market) ? $market->title : 'Shops' }}</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ $id != 0 ? 'show active' : '' }}" data-toggle="tab"
                                href="#addPage">{{ $id == 0 ? 'Add Shop' : 'Update Shop' }}</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-0">
                        @if($id == 0)
                        <div class="tab-pane show active" id="Pages">
                            <div class="card">
                                <div class="header card-header">
                                    <h6 class="title mb-0">All {{ isset($product) ? $product->title : 'Products' }}</h6>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                            <thead>
                                                <tr class="text-center">
                                                    <th><b> #</b></th>
                                                    <th><b>Image</b></th>
                                                    <th><b>Name</b></th>
                                                    <th><b>Address</b></th>
                                                    <th><b>Phone</b></th>
                                                    <th><b>Latitude</b></th>
                                                    <th><b>Longitude</b></th>
                                                    <th><b>Action</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($markets as $key=>$market)
                                                <tr>
                                                    <td>
                                                        <b> {{$loop->index+1}}</b>
                                                    </td>
                                                    <td class="w60">
                                                        <img src="{{ asset('storage/markets/images/box_'.$market->image) }}"
                                                            data-toggle="tooltip" data-placement="top" title="Avatar Name" alt="Avatar"
                                                            class="w35 rounded">
                                                    </td>
                                                    <td>
                                                        {{$market->name}}
                                                    </td>
                                                    <td>
                                                        {{$market->address}}
                    
                                                    </td>
                                                    <td>
                                                        {{$market->phone}}
                    
                                                    </td>
                                                    <td>
                                                        {{$market->latitude}}
                    
                                                    </td>
                    
                                                    <td>
                                                        {{$market->longitude}}
                                                    </td>
                                                    <td class="w60">
                                                        <a href="{{route('markets.edit',base64_encode($market->id))}}">
                                                            <button type="button" class="btn btn-primary btn-sm mb-2" title="Edit"><span
                                                                    class="sr-only">Edit</span> <i class="fa fa-edit"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{route('markets.destroy',base64_encode($market->id))}}"
                                                            onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <button type="button" class="btn btn-danger btn-sm mb-2" title="Delete"><span
                                                                    class="sr-only">Delete</span> <i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{-- {{$products->links()}} --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(isset($item))
                        <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content bg-danger">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Delete Product</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-white">
                                        <p>Are you Sure...!!</p>
                                    </div>
                                    <div class="modal-footer ">
                                        <button type="button" class="btn btn-round btn-default"
                                            data-dismiss="modal">Close</button>
                                        <a href="{{ route('markets.delete',$item->id) }}"
                                            class="btn btn-round btn-primary">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="tab-pane {{ $id != 0 ? 'show active' : '' }}" id="addPage">
                            <div class="card">
                                <div class="header card-header">
                                    <h6 class="title mb-0">{{ isset($market) ? $market->name : 'Add Market' }}</h6>
                                </div>
                                <div class="body mt-2">
                                    <form method="post"
                                        action="{{ $id == 0 ? route('markets.store') : route('markets.update') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="productId" name="id" value="{{ $id != 0 ? $id : '' }}" />
                                          <div class="card">
                                        <div class="row clearfix">
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Name:</span>
                                                        </div>
                                                        <input name="name" type="text"
                                                            class="form-control mobile-phone-number" value="{{ isset($market->name) ? $market->name : null }}"
                                                            placeholder="Enter shop name here..." required>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Currency:</span>
                                                        </div>
                                                        <select name="currency" class="custom-select"
                                                            id="inputGroupSelect01">
                                                            <option selected value="{{isset($site->currency) ? $site->currency : null }}">{{isset($site->currency) ? $site->currency : null }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Address:</span>
                                                        </div>
                                                        <input name="address" type="text" value="{{ isset($market->address) ? $market->address : null }}"
                                                            class="form-control mobile-phone-number"
                                                            placeholder="Enter address here..." required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Phone Number:</span>
                                                        </div>
                                                        <input name="phone" type="text" value="{{ isset($market->phone) ? $market->phone : null }}"
                                                            class="form-control mobile-phone-number"
                                                            placeholder="Ex: +00 (000) 000-00-00" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Latitude:</span>
                                                        </div>
                                                        <input name="latitude" type="number" value="{{ isset($market) ? $market->latitude : null }}"
                                                            class="form-control mobile-phone-number"
                                                            placeholder="123.00030.25" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Longitude:</span>
                                                        </div>
                                                        <input name="longitude" type="number" value="{{ isset($market) ? $market->longitude : null }}"
                                                            class="form-control mobile-phone-number"
                                                            placeholder="963.031303.3" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Option:</span>
                                                        </div>
                                                        <input name="option" type="text"
                                                            class="form-control mobile-phone-number" value="{{ isset($market) ? $market->option : null }}" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <b>Market Image</b>
                                                    <div class="card">
                                                        <div class="body">
                                                            @if($id==0)
                                                            <input name="image" type="file" class="dropify" required>
                                                            @else
                                                            <input name="image" type="file" class="dropify">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($id != 0)
                                            <div class="col-md-6">

                                                <div class="alert alert-success">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-image"></i>
                                                                &nbsp;Current<br>Image
                                                            </span>
                                                        </div>
                                                        <img class="img-thumbnail"
                                                            src="{{ asset('storage/markets/images/box_'.$market->image) }}">
                                                    </div>
                                                    <input type="hidden" name="oldimage" value="{{ $market->image }}">
                                              
                                                </div>

                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fa fa-file-text-o"></i>
                                                                        &nbsp;Description
                                                                    </span>
                                                                </div>
                                                                <textarea class="form-control summernote"
                                                                    name="description">{{ isset($market->description) ? $market->description : null }}</textarea>

                                                            </div>
                                                        </div>
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
<script>
    $(".summernote").summernote({
        disableResizeEditor: true,
        height: 300,
        width: '100%',
    });
</script>
@endpush