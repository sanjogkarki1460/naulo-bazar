@extends('backend.body')
@section('body')
<div id="main-content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Reward Point</h2>
                    </div>
                    <div class="body demo-card">
                        <div class="row clearfix">
                        
                            <div class="col-lg-4 col-md-12">
                                <form action="{{route('reward.create')}}" method="post">
                                    @csrf
                                <label>Category Select</label>
                                <div class="multiselect_div">
                                    <select id="multiselect4-filter" name="category_id" class="multiselect multiselect-custom" >
                                        @foreach($categories as $key => $value)
                                         <option value="{{$value->id}}" @if($value->rewardPoint) disabled @endif>{{$value->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <label>Reward Point </label>
                                <input type="number" name="points" class="form-control">
                                <br>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form> 
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
      
        <div class="row clearfix">
           
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Reward Management <small>Reward Table</small></h2>
                        <ul class="header-dropdown dropdown">
                            
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                        </ul>
                    </div>
                   
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                <thead>
                                    <tr>
                                        <th><b>Category Title</b></th>
                                        <th><b>Reward</b></th>
                                        <th><b>Created At</b></th>
                                        <th><b>Updated At</b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $key => $value)
                                    <tr>
                                        <td>{{$value->title}}</td>
                                        <td>{{$value->rewardPoint ? $value->rewardPoint->points->points : 0}}</td>
                                        <td>{{$value->rewardPoint ? $value->rewardPoint->points->created_at : null}}</td>
                                        <td>{{$value->rewardPoint ? $value->rewardPoint->points->updated_at : null}}</td>
                                        <td> 
                                            @if($value->rewardPoint)
                                            <a href="#mymodal{{ $value->id }}" data-toggle="modal" class="brandedit" data-id="{{ $value->id }}">
                                            <button type="button" class="btn btn-primary btn-sm mb-2 " title="Edit"><span
                                                    class="sr-only">Edit</span><i class="fa fa-edit "></i>
                                            </button>
                                        </a>
                                     
                                        <a href="{{ route('reward.delete',$value->rewardPoint->point_id) }}" onclick="return confirm('Are you sure you want to delete this item?');">
                                            <button type="button" class="btn btn-danger btn-sm mb-2" title="Delete"><span
                                                    class="sr-only">Delete</span> <i class="fa fa-trash-o"></i>
                                            </button>
                                        </a></td>
                                        @endif
                                    </tr>
                                    <div class="modal fade" id="mymodal{{ $value->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Reward Points Edit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form action="{{ route('reward.edit',$value->rewardPoint->point_id) }}" method="post">
                                                        @csrf   
                                                        @method('put')
                                                        <div class="input-group mb-3">
                                                            <input name="title" type="text" value="{{ $value->title }}" class="form-control"
                                                                placeholder="Enter Brand's name here.." disabled>
                                                                
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input name="points" type="number" value="{{ $value->rewardPoint ? $value->rewardPoint->points->points : 0}}" class="form-control"
                                                                placeholder="Enter Brand's name here..">
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-6 col-md-12">
        <p><b>Basic Example</b></p>
        <div id="nouislider_basic_example"></div>
        <div class="m-t-20 font-12"><b>Value: </b><span class="js-nouislider-value"></span></div>
    </div>
    <div class="col-lg-6 col-md-12">
        <p><b>Range Example</b></p>
        <div id="nouislider_range_example"></div>
        <div class="m-t-20 font-12"><b>Value: </b><span class="js-nouislider-value"></span></div>
    </div>
</div>
@endsection
@push('scripts')

<script src="{{asset('backend/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<!-- Bootstrap Tags Input Plugin Js --> 
<script src="{{asset('backend/assets/vendor/nouislider/nouislider.js')}}"></script>
<!-- noUISlider Plugin Js -->
<script src="{{asset('backend/html/assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('backend/html/assets/js/pages/forms/advanced-form-elements.js')}}"></script>

@endpush