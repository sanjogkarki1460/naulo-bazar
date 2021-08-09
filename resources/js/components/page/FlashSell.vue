<template>
  <div>
    <div class="container">
      <div class="flashSale__category">
        
      </div>
      <div class="flashSale__product">
        <div class="row m-0">
          <div v-for="(product,index) in products" :key="index" class="col-6 col-md-4 col-lg-2dot4 p-0">
            <div class="ps-product--standard">
              <a :href="`/product/detail/${product.product.slug}`"
                ><img
                  class="ps-product__thumbnail"
                  :src="product.product.thumbnail"
                  :alt="product.product.name" /></a
              ><a
                class="ps-product__expand"
                @click="triger(product.product)"
                href="javascript:void(0);"
                data-toggle="modal"
                data-target="#popupQuickview"
                ><i class="icon-expand"></i
              ></a>
              <div class="ps-product__content">
                <p class="ps-product__type">
                  <i class="icon-store"></i>{{product.product.user.name}}
                </p>
                <h5>
                  <a class="ps-product__name" :href="`/product/detail/${product.product.slug}`"
                    >{{product.product.name}}</a
                  >
                </h5>
                <p class="ps-product__unit">{{product.product.unit}}</p>
                <star-rating :increment="0.2" :star-size="15" :read-only="true" :show-rating="false" :rating="product.product.rating"></star-rating>
                <p class="ps-product-price-block">
                  <span class="ps-product__sale">Rs{{product.product.selling_price}}</span
                  ><span class="ps-product__price" v-if="product.product.discount">Rs{{product.product.unit_price}}</span
                  >
                  <!-- <span class="ps-product__off">23% Off</span> -->
                </p>
                
              </div>
              <cart :product="product.product"></cart>
            </div>
          </div>
        </div>
      </div>
      <div class="flashSale__loading"  v-if="loading">
        <p>LOADING...</p>
      </div>
      <div v-observe-visibility="infiniteScroll"></div>
    </div>
  </div>
</template>
<script>
export default {
    props:['flash_product'],
    data(){
        return{
            products:[],
            nextUrl:null,
            loading: true,
        }
    },
    methods:{
        triger(product){
            EventBus.$emit('show-model', product);
        },
        getProduct(){
            axios.get(`/all/flash/product/${this.flash_product}`)
            .then(({data})=>{
                this.products = data.data;
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
    }
}
</script>
