@extends('frontend.body.body')
@section('body')
    <!-- slider-banner -->
    <div class="banner">
        <figure class="background-img"
                style="background-image:url('{{asset('frontend/images/banner.png')}}') ">
        </figure>
    </div>
    <!-- booking -->
    <section id="booking-page" class="booking-page">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h3>Follow Our Shop</h3>
                </div>
            </div>
            <div class="row mt-5">
                @foreach($markets as $key => $value)
                    <div class="col-md-4">
                        <div class="booking-card position-relative">
                            <div class="booking-card-img">
                                <figure><img src="{{ asset('storage/markets/images/box_'.$value->image) }}" alt="image">
                                </figure>
                            </div>
                            <div class="overlay"></div>
                            <div class="booking-card-detail">
                                <div class="booking-title">
                                    <h3><a href="{{url('vendor',base64_encode($value->id))}}">{{$value->name}}
                                        </a></h3>
                                </div>
                                <div class="booking-info">
                                    <p>{!!$value->description!!}</p>
                                </div>
                                @if(Auth::check())
                                    @if(Auth::user()->hasSubscribed($value))
                                        <a href="{{route('vendor.follow',$value->id)}}" class="btn btn-primary">
                                            Following <i class="fas fa-check"></i>
                                        </a>
                                    @else
                                        <a href="{{route('vendor.follow',$value->id)}}" class="btn btn-primary">
                                            Follow
                                        </a>
                                    @endif
                                @else
                                    <a href="{{route('vendor.follow',$value->id)}}" class="btn btn-primary">
                                        Follow
                                    </a>
                                @endif


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection