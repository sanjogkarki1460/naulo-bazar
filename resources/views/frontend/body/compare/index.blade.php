@extends('frontend.body.body')
@section('body')
    <!-- Copmpare page section -->
    <section id="cart-page">

        <div class="container mt-5">
            <div class="row ">
                <div class="col-md-12 mb-3">
                    <div class="cart box-shadow ">
                        <div class="card-header d-flex align-items-center">
                            <h4 class="mb-0 mr-3">Comparision</h4>
                            <small class=" badge badge-primary"> 2 items</small>
                        </div>
                        <div class="card-body cart-box">
                            @if(session()->get('compare'))
                            <table class="table table-bordered">
                                
                                <tr>
                                    <th>Name </th>
                               
                                    @foreach(session()->get('compare')->items as $key => $value)
                                <th class="position-relative">{{$value['items']->title}}  <a href="{{route('remove.compare',$value['items']->id)}}"><i class="fas fa-times remove-compare"></i></a></th>
                                    @endforeach
                               
                                </tr>
                                <tr>
                                    <th>Image </th>
                                    @foreach(session()->get('compare')->items as $key => $value)
                                    <th> @if(file_exists(public_path('storage/products/'.$value['items']->slug.'/'.$value['items']->image)))
                                        <img 
                                            src="{{asset('storage/products/'.$value['items']->slug.'/'.$value['items']->image)}}" style="width: 150px">
                                        @else
                                        <img src="{{asset('frontend/images/product-1.png')}}"  style="width: 150px">
                                        @endif
                                    @endforeach
                                 
                                </tr>
                                <tr>
                                    <th>Price </th>
                                    @foreach(session()->get('compare')->items as $key => $value)
                                    <th>Rs .{{$value['items']->price}}</th>
                                    @endforeach
                                 
                                </tr>
                                <tr>
                                    <th>Brand </th>
                                    @foreach(session()->get('compare')->items as $key => $value)
                                        <th>{{$value['items']->brand->title}}</th>
                                    @endforeach
                                   
                                </tr>
                                <tr>
                                    <th>Sub Sub Category </th>
                                    @foreach(session()->get('compare')->items as $key => $value)
                                      <th>{{$value['items']->category->title}}</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Description </th>
                                    @foreach(session()->get('compare')->items as $key => $value)
                                        <th>{!! $value['items']->short_content !!}</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th> </th>
                                    @foreach(session()->get('compare')->items as $key => $value)
                                        <th><button class="btn btn-primary btn-sm btn-rounded ">Add to Cart</button> </th>
                                    @endforeach
                                </tr>
                                @endif
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection