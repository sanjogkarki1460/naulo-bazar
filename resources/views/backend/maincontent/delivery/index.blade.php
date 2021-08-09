@extends('backend.body')
@section('title',  'Delivery')
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
                            href="#Pages">{{ isset($delivery) ? $delivery->title : 'Delivery Setting' }}</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ $id != 0 ? 'show active' : '' }}" data-toggle="tab"
                            href="#addPage">{{ $id == 0 ? 'Add Delivery Charge' : 'Update Delivery' }}</a>
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
                                                <th>Name  </th>
                                                <th>Charge</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!$deliveries->isEmpty())
                                            @foreach($deliveries as $delivery)
                                            <tr class="text-center">
                                                <td>{{$loop->index+1}}</td>
                                                <td>
                                                    <div class="font-15">{{ucfirst($delivery->title)}}</div>
                                                </td>
                                               <td>{{ $delivery->charge }}</td>
                                                <td>
                                                    <a href="{{route('delivery.edit',$delivery->id)}}"
                                                        class="btn btn-sm btn-default"><i
                                                            class="fa fa-edit text-info"></i></a>

                                                            
                                                    <form id="deleteContact"
                                                        action=""
                                                        method="post" style="display: inline">
                                                        @csrf
                                                        <a href="{{ route('delivery.delete',$delivery->id) }}" id="contactDelete"
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
                    {{--End Modal--}}
                    <div class="tab-pane {{ $id != 0 ? 'show active' : '' }}" id="addPage">
                        <div class="card">
                            <div class="header card-header">
                                <h6 class="title mb-0">{{ isset($market) ? $market->name : 'Add Commission' }}</h6>
                            </div>
                            <div class="body mt-2">
                                <form method="post"
                                    action=" {{ $id !=0 ? route('delivery.update',$delivery->id) :  route('delivery.store')  }} "
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
                                                        City Name
                                                    </div>
                                                    <div class="body">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <label for="">Insert City Address</label>
                                                                <br>
                                                                <input type="text" name="title" class="form-control"  value="{{$id !=0  ? $delivery->title : null}}">
                                                            </div>
                                                        </div>
                                                        <div class="row"></div>
                                                    </div>

                                                </div>
                                                <br>
                                                <div class="alert alert-warning">
                                                    <p><b>The charge here will be multiplied, according to product delivery charge</b></p>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header ">
                                                        Add Charge
                                                    </div>
                                                    <div class="body">
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <input type="number" name="charge" value="{{$id !=0  ? $delivery->charge : null}}">
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

