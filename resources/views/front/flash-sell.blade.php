@extends('layout.front')
@section('content')
<main class="no-main">
    <section class="section--flashSale">
        <div class="flashSale__banner">
        <div class="inner_banner">
    		<a href="#">
    		  <img src="{{asset('assets/img/promotion/flash-share.jpg')}}" alt>
                <div class="ps-banner--block">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-2"></div>
                            <div class="col-12 col-lg-10">
                                <div class="ps-banner__content">
                                    <div class="ps-banner__discount">50<span class="ps-discount"> <span class="ps-discount__font">% </span><span class="ps-discount__text">OFF</span></span></div>
                                    <div class="ps-banner__text">
                                        <div class="ps-banner__title">get your own <br>daily big & best deals.</div>
                                        <div class="ps-banner__subtitle">Update at 12 AM everyday.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    		</a>
        </div>
        </div>
        <div class="flashSale__header">
            <div class="container">
                <h3 class="flashSale__title">Flash Sale<span class="ps-countdown"><span class="ps-countdown-end">Ends in : </span><span class="ps-countdown"><b class="hours">00</b> hours : <b class="minutes">12</b> mins : <b class="seconds">45</b> secs</span><span class="ps-countdown mobile"><b class="hours">00</b> h : <b class="minutes">12</b> m : <b class="seconds">45</b> s</span></span></h3>
            </div>
        </div>
        <flash-sell :flash_product="{{$flashDeal->id}}"></flash-sell>
    </section>
</main>
@endsection