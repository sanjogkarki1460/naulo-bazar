@extends('backend.body')
@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Message List</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dasboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Message</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Message List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="table-responsive invoice_list mb-4">
                        <table class="table table-hover table-custom spacing8">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">#</th>
                                    <th style="width: 50px;">Name</th>
                                    <th style="width: 110px;">Message</th>
                                    <th style="width: 110px;">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $key => $value)
                                <tr>
                                    <td>
                                    <span>{{$value->id}}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                        <div class="avtar-pic w35 bg-red" data-toggle="tooltip" data-placement="top" title="{{$value->name}}"><span>SS</span></div>
                                            <div class="ml-3">
                                            <a href="#" title="">{{$value->name}}</a>
                                                <p class="mb-0">{{$value->email}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$value->message}}</td>
                                    <td>
                                    <a href="{{route('contact.delete',$value->id)}}" type="button" class="btn btn-sm btn-default" title="Delete" data-toggle="tooltip" data-placement="top"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


