@extends('backend.body')
@section('title','Settings')
@section('body')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Site Settings</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Customize your Site</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin-dashboard')}}" class="btn btn-sm btn-round btn-outline-primary" title=""><i
                            class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
				
  
                <div class="card">
					  <div class="body">
						  
                    <div class="header">
                    </div>
						  
                  
						<form class="form-horizontal" action="{{ route('sites.update') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <input type="hidden" name="_method" value="Post">
							
							   <div class="row">
                                <div class="col-md-6">
                                    <div class="card">

                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fa fa-file-image-o"></i> &nbsp;Logo </span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" name="logo" class="custom-file-input"
                                                                id="inputGroupFile03">
                                                            <label class="custom-file-label" for="inputGroupFile03">Choose
                                                                Logo</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    @if(isset($setting->logo))
                                                    
                                                    <img src="{{ asset('storage/setting/logo/'.$setting->logo) }}"
                                                        data-toggle="tooltip" data-placement="top" title="" alt="Logo"
                                                        class="rounded img-thumbnail" width="100px" height="100px"
                                                        data-original-title="Logo">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fa fa-file-image-o"></i> &nbsp;Favicon </span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" name="favicon" class="custom-file-input"
                                                                id="inputGroupFile03">
                                                            <label class="custom-file-label" for="inputGroupFile03">Choose
                                                                Favicon</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    @if(isset($setting->favicon))
                                                    <img src="{{ asset('storage/setting/favicon/'.$setting->favicon) }}"
                                                        data-toggle="tooltip" data-placement="top" title="" alt="Favicon"
                                                        class="rounded img-thumbnail" width="50px"
                                                        data-original-title="Favicon">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;{{__('Site Name')}}</span>
                                        </div>
                                         <input type="text" id="name" name="name" value="{{ $setting->site_name }}" class="form-control" required>
                                    </div>
                                </div>
								   
								    <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;{{__('Address')}}</span>
                                        </div>
                                        <input type="text" id="address" name="address" value="{{ $setting->address }}" class="form-control" required>
                                    </div>
                                </div>
								   
								   
								     <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;{{__('Phone')}}</span>
                                        </div>
                                         <input type="text" id="phone" name="phone" value="{{ $setting->phone }}" class="form-control" required>
                                    </div>
                                </div>
								   
								     <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;{{__('Email')}}</span>
                                        </div>
                                           <input type="text" id="email" name="email" value="{{ $setting->email }}" class="form-control" required>
                                    </div>
                                </div>
								   
								 
								     
								    <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;{{__('Facebook')}}</span>
                                        </div>
                                          <input type="text" id="facebook" name="facebook" value="{{ $setting->facebook }}" class="form-control">
                                    </div>
                                </div>
								   
								     
								    <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;{{__('Instagram')}}</span>
                                        </div>
                                         <input type="text" id="instagram" name="instagram" value="{{ $setting->instagram }}" class="form-control">
                                    </div>
                                </div>
								   
								   
								     
								    <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;{{__('Twitter')}}</span>
                                        </div>
                                     <input type="text" id="twitter" name="twitter" value="{{ $setting->twitter }}" class="form-control">
                                    </div>
                                </div>
								   
								   
								    <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;{{__('Youtube')}}</span>
                                        </div>
                                   <input type="text" id="youtube" name="youtube" value="{{ $setting->youtube }}" class="form-control">
                                    </div>
                                </div>
								   
								   
								   
								   	   
								    <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;{{__('Google Plus')}}</span>
                                        </div>
                                  <input type="text" id="google_plus" name="google_plus" value="{{ $setting->google_plus }}" class="form-control">
                                    </div>
            
							   </div>                  

										    <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;{{__('Footer Text')}}</span>
                                        </div>
                                  <textarea class="form-control summernote" rows="4" name="description" required>{{$setting->description}}</textarea>
                                    </div>
										
                                </div>                  
							    
							</div>
							
							 	   
					
							
                <div class="panel-footer text-right m-2">
                    <button class="btn btn-success" type="submit">{{__('Save')}}</button>
                </div>
            </form>
						
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>

@endsection