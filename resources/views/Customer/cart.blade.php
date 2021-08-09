@extends('layout.front')
@section('content')
<main class="no-main">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="ps-breadcrumb__list">
                <li class="active"><a href="{{route('welcome')}}">Home</a></li>
                <li class="active"><a href="{{route('welcome')}}">Shop</a></li>
                <li><a href="javascript:void(0);">Shopping Cart</a></li>
            </ul>
        </div>
    </div>
        
    <cart-detail></cart-detail>

</main>
@endsection