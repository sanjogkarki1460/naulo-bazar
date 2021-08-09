<template>
<div class="section-slide--default">
    <div class="owl-carousel" data-owl-auto="false" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
        <div v-for="(banner,index) in banners" :key="index+1" class="ps-banner"><img class="mobile-only" src="assets/img/slider/home-dark/slide-mobile-01.jpg" alt="alt" />
        <img class="desktop-only" src="assets/img/slider/home-dark/slide-dark-01.jpg" alt="alt" />
            <div class="ps-content">
                <div class="container">
                    <div class="ps-content-box">
                        <div class="ps-node">MART FROM ONE STORE</div>
                        <div class="ps-title">Welcome to <b class='text-success'>Onestore</b> Foods & Organic Online.</div>
                        <div class="ps-subtitle">* Free delivery for your first order</div>
                        <div class="ps-shopnow"> <a :href="banner.url">Shop Now<i class="icon-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default{
  props:['banners'],
  data(){
    return{
      //
    }
  }
}
</script>
