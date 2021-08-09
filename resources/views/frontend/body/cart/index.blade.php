@extends('frontend.body.body')
@section('body')

@if(Auth::check())
@include('frontend.body.cart.user-cart')
@else
@include('frontend.body.cart.guest-cart');
@endif
@endsection