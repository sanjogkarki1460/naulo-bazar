<template>
  <div class="header-inner__right">
    <wishlist-notification></wishlist-notification>
    <div class="button-icon btn-cart-header">
      <i v-if="status" class="icon-cart icon-shop5 text-white"></i
      >
      <i @click="redirectToLogin" v-else  class="icon-cart icon-shop5 text-white"></i
      ><span class="badge bg-warning">{{count}}</span>
      <div class="mini-cart" v-if="status">
        <div class="mini-cart--content">
          <div class="mini-cart--overlay"></div>
          <div v-if="count>0" class="mini-cart--slidebar cart--box" >
            <div class="mini-cart__header">
              <div class="cart-header-title">
                <h5>Shopping Cart({{count}})</h5>
                <a class="close-cart" href="javascript:void(0);"
                  ><i class="icon-arrow-right"></i
                ></a>
              </div>
            </div>
            <div class="mini-cart__products">
              <div class="out-box-cart">
                <div class="triangle-box">
                  <div class="triangle"></div>
                </div>
              </div>
              <ul class="list-cart">
                <li v-for="cart in cart_products" :key="cart.id"  class="cart-item">
                  <div class="ps-product--mini-cart">
                    <a :href="`/product/detail/${cart.product.slug}`"
                      ><img
                        class="ps-product__thumbnail"
                        :src="cart.product.thumbnail"
                        alt="alt"
                    /></a>
                    <div class="ps-product__content">
                      <a class="ps-product__name" :href="`/product/detail/${cart.product.slug}`"
                        >{{cart.product.name}}</a
                      >
                      <p class="ps-product__unit">{{cart.product.unit}}</p>
                      <p class="ps-product__meta">
                        <span class="ps-product__price">Rs{{cart.price}}</span
                        ><span class="ps-product__quantity">(x{{cart.quantity}})</span>
                      </p>
                    </div>
                    <div class="ps-product__remove" >
                      <i @click="deleteCartProduct(cart.id)" class="icon-trash2"></i>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <div class="mini-cart__footer row">
              <div class="col-6 title">TOTAL</div>
              <div class="col-6 text-right total">Rs. {{total}}</div>
              <div class="col-12 d-flex">
                <a class="view-cart" href="/customer/cart">View cart</a
                ><a class="checkout" href="/customer/checkout">Checkout</a>
              </div>
            </div>
          </div>
          <div v-else class="mini-cart--slidebar cart--box" style="height:100px">
            <p class="text-center"> No product found</p>
          </div>
        </div>
      </div>
    </div>
    <div class="ps-top__total">Shopping Cart<b>Rs. {{total}}</b></div>
  </div>
</template>
<script>
export default {
    data(){
        return{
            status:false,
            count:null,
            cart_products:[],
        }
    },
    methods:{
        getCartProduct(){
            axios.get(`/customer/cart/product`)
                 .then(response=>{
                     this.cart_products = response.data;
                     this.count = this.cart_products.length;
                     this.status = true
                 })
                 .catch(error=>{
                     this.count = null
                     this.response = false
                 });


        },

        deleteCartProduct(id){
            axios.delete(`/customer/deleteCart/${id}`)
                 .then(response=>{
                     this.$toast.success(response.data.message, 'success', {
                        timeout: 3000,
                        position: "topRight",
                     });
                     this.getCartProduct(); 
                 })
                 .catch(error=>{
                     this.$toast.error(error.response.data.message, 'Error', {
                        timeout: 3000,
                        position: "topRight",
                     });
                 });
        },

        redirectToLogin(){
            window.location.href = '/customer/login';
        },
    },
    
    created(){
        EventBus.$on('cart', data=> {
             this.getCartProduct();    
        });
        this.getCartProduct();
    },
    computed:{
        total(){
            let val = 0;
            this.cart_products.forEach(product=>{
                val += product.price * product.quantity; 
            })
            return val;
        }
    }

};
</script>