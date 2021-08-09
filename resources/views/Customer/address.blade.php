@extends('layout.front')
@section('content')
<main class="no-main">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="ps-breadcrumb__list">
                    <li class="active"><a href="{{route('welcome')}}">Home</a></li>
                    <li><a href="javascript:void(0);">User Address Book</a></li>
				</ul>
			</div>
		</div>

        <section class="section--become">

            <h2 class="page__title">My Address Book</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                        @include('front.partials.dashboardSidebar')
                        </div>
                        <div class="col-12 col-lg-9">
                          @if($address)
                            <customer-address :detail="{{$address}}" action="update"></customer-address>
                          @else
                          <customer-address action="insert"></customer-address>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div> 
        </section>
    </main>
@endsection