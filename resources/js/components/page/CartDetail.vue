<template>
  <section class="section--shopping-cart">
    <div class="container shopping-container">
      <h2 class="page__title">Shopping Cart</h2>
      <div class="shopping-cart__content">
        <div class="row m-0">
          <div class="col-12 col-lg-8">
            <div class="shopping-cart__products">
              <div class="shopping-cart__table">
                <div class="shopping-cart-light">
                  <div class="shopping-cart-row">
                    <div class="cart-product">Product</div>
                    <div class="cart-price">Price</div>
                    <div class="cart-quantity">Quantity</div>
                    <div class="cart-total">Total</div>
                    <div class="cart-action"></div>
                  </div>
                </div>
                <div v-if="count > 0" class="shopping-cart-body">
                  <div  class="shopping-cart-row" v-for="cart in cart_products" :key="cart.id">
                    <cart-single :cart="cart"></cart-single>
                  </div>
                </div>
                <div v-else class="shopping-cart-body">
                  <p class="text-center">No product found</p>
                </div>
              </div>
              <div class="shopping-cart__step">
                <a v-if="count>0" class="clear-item" @click="deleteAll" href="javascript:void(0);"
                  >Clear all items</a
                ><a class="button right" @click="updateCartProduct" href="javascript:void(0);"
                  ><i class="icon-sync"> </i>Update Cart</a
                ><a class="button left" :href="`/`"
                  ><i class="icon-arrow-left"></i>Continue Shopping</a
                >
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-4">
            

            <div class="shopping-cart__right">
              <div class="shopping-cart__total">
                <p class="shopping-cart__subtotal">
                  <span>Subtotal</span><span class="price">Rs. {{subtotal}}</span>
                </p>
                <p class="shopping-cart__subtotal">
                  <span>Shipping Fee</span> <span class="price">Rs. {{totalShippingCost}}</span>
                </p>

                <p class="shopping-cart__subtotal">
                  <span>Tax</span> <span class="price">Rs. {{totalTaxCost}}</span>
                </p>
                <div class="shopping-cart__block">
                  <h3 class="block__title">Using A Promo Code?</h3>
                  <div class="input-group">
                    <input v-model="coupon"
                      class="form-control"
                      type="text"
                      placeholder="Coupon code"
                    />
                    
                    <div class="input-group-append">
                      <button @click="apply" class="btn">Apply</button>
                    </div>
                  </div>
                  <small style="color:green margin:5px" v-if="message">{{message}}</small>
                </div>
                <p class="shopping-cart__subtotal">
                  <span><b>TOTAL</b></span
                  ><span class="price-total">Rs {{total(subtotal,totalShippingCost,totalTaxCost)}}</span>
                </p>
              </div>
              <a class="btn shopping-cart__checkout" href="/customer/checkout"
                >Proceed to Checkout</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import CartSingle from '../cartSingle.vue';
export default {
  data() {
    return {
      discount:0,
      message:'',
      coupon:'',
      count:0,
      cart_products: {},
    };
  },
  methods: {
    total(subtotal,totalShippingCost,totalTaxCost){
      return subtotal+totalShippingCost+totalTaxCost;
    },
    apply(){
      if(this.coupon ==''){
        return;
      }
      axios.get(`/customer/coupon`,{
        params:{
          coupon: this.coupon,
        }
      }).then(response=>{
        
        this.$toast.success(response.data.message, 'success', {
           timeout: 3000,
           position: "topRight",
        });
        this.message ="you got discount of Rs."+response.data.discount;
      }).catch(error=>{
        this.$toast.error(error.response.data.error, 'error', {
           timeout: 3000,
           position: "topRight",
        });
        //this.message ="";
      });
    },
    getCartProduct() {
      axios
        .get(`/customer/cart/product`)
        .then((response) => {
          this.cart_products = response.data;
          this.count = this.cart_products.length;
        })
        .catch((error) => {});
    },
    
    deleteAll(){
        axios.delete(`/customer/delete/all/cart`)
             .then(response=>{
                 this.$toast.success(response.data, 'success', {
                    timeout: 3000,
                    position: "topRight",
                 });
                 EventBus.$emit('cart','check');
                 this.getCartProduct(); 
             })
             .catch();
    },
    updateCartProduct(){
      this.getCartProduct();
      this.$toast.success('Cart updated succefully ', 'success', {
         timeout: 3000,
         position: "topRight",
      });
    }
        
  },
  created() {
    EventBus.$on('cart', data=> {
           this.getCartProduct();    
      });
    this.getCartProduct();
  },
  computed:{
        subtotal(){
            
            let val = 0;
            if(this.count>0){
                this.cart_products.forEach(product=>{
                val += product.price * product.quantity; 
            })
            }
            
            return val;
        },

        totalShippingCost(){
            
            let shipping_cost = 0;
            if(this.count>0){
                this.cart_products.forEach(product=>{
                shipping_cost += product.shipping_cost; 
            })
            }
            
            return shipping_cost;
        },

        totalTaxCost(){
            let tax_cost = 0;
            if(this.count>0){
                this.cart_products.forEach(product=>{
                tax_cost += product.tax; 
            })
            }
            
            return tax_cost;
        }


    }
};
</script>