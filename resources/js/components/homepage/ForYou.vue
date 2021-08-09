<template>
<section class="ps-component ps-component--selling jfu-onestore-sell">
    <div class="container">
        <div class="component__header">
        <h3 class="component__title">Just For You</h3>
    </div>
        <div class="component__content">
            <div class="row m-0">
                <div v-for="(product,index) in products" :key="index" class="col-6 col-md-4 col-lg-3 col-xl-2 p-0">
                    <div class="ps-sell__product">
                        <div class="ps-product--standard">
                            <a :href="`/product/detail/${product.slug}`">
                            <img class="ps-product__thumbnail" :src="product.thumbnail" alt="alt" />
                            </a>
                            <wishlist :product="product"></wishlist>
                            <!-- <span class="ps-badge ps-product__new"></span> -->
                            <div class="ps-product__content">
                                <p class="ps-product__type"><i class="icon-store"></i>{{product.user.name}}</p>
                                <h5><a class="ps-product__name" :href="`/product/detail/${product.slug}`">{{product.name}}</a></h5>
                                <p class="ps-product__unit">{{product.unit}}</p>
                                
                                <star-rating :increment="0.2" :star-size="15" :read-only="true" :show-rating="false" :rating="product.rating"></star-rating>
                               
                                <p class="ps-product-price-block"><span class="ps-product__price-default">Rs {{product.selling_price}}</span><span class="ps-product__price" v-if="product.discount"
                                                    >Rs{{ product.unit_price }}</span>
                                
                                </p>
                            </div>
                            <cart :product="product"></cart>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flashSale__loading" v-if="loading">
            <p>LOADING...</p>
        </div>
        <div v-observe-visibility="infiniteScroll"></div>
    </div>
</section>
</template>
<script>
export default {
    data(){
        return{
            products:[],
            nextUrl:null,
            loading: true,
        }
    },
    methods:{
        getProduct(){
            axios.get(`/all/product`)
            .then(({data})=>{
                this.products = data.data;
                console.log(data.next_page_url);
                this.nextUrl = data.next_page_url
                this.loading = true;
            })
            .catch()
        },
        infiniteScroll(){
        if(this.nextUrl!=null){
            axios.get(this.nextUrl)
            .then(({data})=>{
                this.products.push(...data.data);
                this.nextUrl = data.next_page_url
                console.log(this.nextUrl);
                
            })
            .catch()
            }else{
                this.loading= false;
            }
        }
        

    },
    created(){
        this.getProduct();
    },
    
}
</script>
