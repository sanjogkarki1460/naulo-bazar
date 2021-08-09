<template>
<div>
    <div class="modal fade" id="popupQuickview" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl ps-quickview">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid quickview-body">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="owl-carousel" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-item-xl="1" data-owl-duration="1000" data-owl-mousedrag="on">
                                    <div class="quickview-carousel" v-for="image in product.main_image" :key="image" ><img class="carousel__thumbnail" :src="image" alt="alt" /></div>
                                    
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="quickview__product">
                                    <div class="product__header">
                                        <div class="product__title">{{product.name}}</div>
                                        <div class="product__meta">
                                            <div class="">
                                                <star-rating :increment="0.2" :star-size="15" :read-only="true" :show-rating="false" :rating="product.rating"></star-rating>
                                                <span>{{product.reviews.length}} customer reviews</span>
                                            </div>
                                            <div class="product__code"><span>SKU: </span>#VEG20938</div>
                                        </div>
                                    </div>
                                    <div class="product__content">
                                        <div class="product__price"><span class="sale">Rs{{product.selling_price}}</span><span class="price">Rs6.90</span><span class="off">25% Off</span></div>
                                        <p class="product__unit">{{product.unit}}</p>
                                        <div class="alert__success">Availability: <span>{{product.current_stock}} in stock</span></div>
                                        <ul>
                                            <li>Type: Organic</li>
                                            <li>MFG: Jun 4, 2020</li>
                                            <li>LIFE: 365 days</li>
                                        </ul>
                                    </div>
                                    <div class="product__action">
                                        <label>Quantity: </label>
                                        <div class="def-number-input number-input safari_only">
                                            <button class="minus" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="icon-minus"></i></button>
                                            <input class="quantity" min="0" name="quantity" value="1" type="number">
                                            <button class="plus" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="icon-plus"></i></button>
                                        </div>
                                        <button class="btn product__addcart"> <i class="icon-cart"></i>Add to cart</button>
                                        <wishlist :product="product"></wishlist>
                                    </div>
                                    <div class="product__footer">
                                        <div class="ps-social--share"><a class="ps-social__icon facebook" href="#"><i class="fa fa-thumbs-up"></i><span>Like</span><span class="ps-social__number">0</span></a><a class="ps-social__icon facebook" href="#"><i class="fa fa-facebook-square"></i><span>Like</span><span class="ps-social__number">0</span></a><a class="ps-social__icon twitter" href="#"><i class="fa fa-twitter"></i><span>Like</span></a><a class="ps-social__icon" href="#"><i class="fa fa-plus-square"></i><span>Like</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
     
</template>
<script>

export default {
    data(){
        return{
            product:{},
        }
    },
    methods:{
        showModel(){
            $('#popupQuickview').modal('show');
        }
    },
    created(){
        EventBus.$on('show-model', product => {
                this.product = product;
                $('#popupQuickview').modal('show');
        });
    }
}
</script>