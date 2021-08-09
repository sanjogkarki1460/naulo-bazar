@extends('backend.master')
@section('content')

    <div id="wrapper">

       {{-- =============Nav Bar=========== --}}

        @include('backend.nav.nav')

        @include('backend.nav.search')
     
        @include('backend.nav.megamenu')

        @if(Auth::user()->hasRole('admin'))
        @include('backend.sidebar.leftbar')
        @elseif(Auth::user()->hasRole('vendor'))
        @include('backend.sidebar.seller_nav')
        @endif
        @yield('body')
      
    </div>
    
@endsection