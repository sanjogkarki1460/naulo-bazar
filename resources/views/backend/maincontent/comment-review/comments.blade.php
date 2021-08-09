@extends('backend.body')
@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h1>Comments and Review</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Products</a></li>
                                <li class="breadcrumb-item"><a href="#">Comments</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Comments and Review</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom spacing5 ">
                                    <thead>
                                    <tr>
                                        <th><b>Name </b></th>
                                        <th><b>Product Name</b></th>
                                        <th>Review</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                        <th><b>Action</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($comments as $key => $value)
                                        <tr>
                                            <td>{{$value->user->name}}<p class="mb-0">{{$value->user->email}}</p></td>
                                            <td>{{$value->product->name}}</td>
                                            <td>{{$value->comment}}</td>
                                            <td>5</td>
                                            <td>@if($value->status == 1) Active @else Not Active @endif</td>
                                            <td>
                                                <span class="content-right">
                                                        {{--@if($value->status == 0)--}}
                                                        {{--<a href="{{route('comments.accept',$value->id)}}"--}}
                                                           {{--class="btn btn-sm btn-outline-primary" title="Edit"><i--}}
                                                                    {{--class="fa fa-check"></i></a>--}}
                                                    {{--@else--}}
                                                        {{--<a href="{{route('comments.decline',$value->id)}}"--}}
                                                           {{--class="btn btn-sm btn-outline-danger" title="Edit"><i--}}
                                                                    {{--class="fa fa-times"></i></a>--}}
                                                    {{--@endif--}}
                                                    <a href="{{route('comments.delete',$value->id)}}"
                                                       onclick="return confirm('Are you sure you want to delete this item?');"
                                                       class="btn btn-sm btn-outline-danger center-block"><i
                                                                class="fa fa-trash"></i></a>
                                                </span>
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

        </div>
    </div>

    </div>
@endsection


