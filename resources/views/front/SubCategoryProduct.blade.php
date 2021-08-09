@extends('layout.front')
@section('content')
<main class="no-main">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="ps-breadcrumb__list">
                <li class="active"><a href="{{route('welcome')}}">Home</a></li>
                <li class="active"><a href="{{route('category.product',$subcategory->category->slug)}}">{{$subcategory->category->name}}</a></li>
                <li class="active"><a href="#">{{$subcategory->name}}</a></li>
                <li><a href="javascript:void(0);">Product List</a></li>
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
    <sub-category-product :category="{{$subcategory}}" :brands="{{$brand}}"></sub-category-product>
</main>
@endsection