@extends('layout.front')
@section('content')
<main class="no-main">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="ps-breadcrumb__list">
                <li class="active"><a href="{{route('welcome')}}">Home</a></li>
                <li><a href="javascript:void(0);">Search result</a></li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="inner_banner">
            <a href="#">
                <img src="{{asset('assets/img/promotion/promo-03.jpg')}}" alt>
            </a>
        </div>
    </div>
   
    <search-result :brands="{{$brand}}" 
        @if($category) category="{{$category}}" 
        @endif  @if($keyword) 
        keyword="{{$keyword}}" 
        @endif
    ></search-result>

</main>
@endsection