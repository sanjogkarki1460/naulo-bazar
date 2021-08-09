<template>
    <section class="section--checkout">
        <form>
        <div class="container">
            <h2 class="page__title">Checkout</h2>
            <div class="checkout__content">
                <div class="checkout__header">
                    <div class="row">
                        <div class="col-12 col-lg-7">
                            <div class="checkout__header__box">
                                <p><i class="icon-user"></i>Returning customer? <a href="#">Click here to login</a></p><i class="icon-chevron-down"></i>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="checkout__header__box">
                                <p><i class="icon-tags"></i>Have a coupon? <a href="#">Click here to renter your code</a></p><i class="icon-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-7">
                        <h3 class="checkout__title">Billing Details</h3>
                        <div class="checkout__form">
                                <div class="form-row">
                                    <div class="col-12 form-group--block">
                                        <label>Name: <span>*</span></label>
                                        <input v-model="address.name" class="form-control" type="text" placeholder="Name" required>
                                    </div>
                                    
                                    <div class="col-12 form-group--block">
                                        <label>address: <span>*</span></label>
                                        <input v-model="address.address" class="form-control" type="text" placeholder="Delivery address">
                                    </div>

                                    <div class="col-12 form-group--block">
                                        <label>Famous place nearby: <span>*</span></label>
                                        <input v-model="address.landmark" class="form-control" type="text" required placeholder="Famous Place Nearby">
                                    </div>

                                    <div class="col-12 form-group--block">
                                        <label>Phone: <span>*</span></label>
                                        <input v-model="address.phone" class="form-control" placeholder="phone" type="text" required>
                                    </div>

                                    <div class="col-12 form-group--block">
                                        <label>Email address: <span>*</span></label>
                                        <input v-model="address.email" class="form-control" name="Email" type="email" required>
                                    </div>
                                    
                                    <div class="col-12 form-group--block">
                                        <label>Order notes (optional)</label>
                                        <textarea class="form-control" v-model="address.order_note" placeholder="Note about your orders, e.g special notes for delivery."></textarea>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <h3 class="checkout__title">Your Order</h3>
                        <div class="checkout__products">
                            <div class="row">
                                <div class="col-8">
                                    <div class="checkout__label">PRODUCT</div>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="checkout__label">TOTAL</div>
                                </div>
                            </div>
                            <div class="checkout__list">
                                <div v-for="cart in cart_products" :key="cart.id" class="checkout__product__item">
                                    <div class="checkout-product">
                                        <div class="product__name">{{cart.product.name}}<span>(x{{cart.quantity}})</span></div>
                                        <div class="product__unit">{{cart.unit}}</div>
                                    </div>
                                    <div class="checkout-price">Rs{{cart.price}}</div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="checkout__label">Subtotal</div>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="checkout__label">Rs{{subtotal}}</div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-8">
                                    <div class="checkout__label">Shipping Fee</div>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="checkout__label">Rs {{totalShippingCost}}</div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-8">
                                    <div class="checkout__label">Tax</div>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="checkout__label">Rs {{totalTaxCost}}</div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-8">
                                    <div class="checkout__total">Total</div>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="checkout__money">Rs {{total(subtotal,totalShippingCost,totalTaxCost)}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__payment">
                            <div class="checkout__label mb-3">SELECT PAYMENT</div>
                            <div class="form-group--block">
                                <input class="form-check-input" disabled type="checkbox"  id="checkboxBank" value="bank">
                                <label class="label-checkbox" for="checkboxBank"><b class="text-heading">Direct bank transfer</b></label>
                            </div>
                            <div class="form-group--block">
                                <input class="form-check-input" type="checkbox" value="cash on delivery" v-model="payment_type" id="checkboxCash" checked="checked">
                                <label class="label-checkbox" for="checkboxCash"><b class="text-heading">Cash on delivery</b></label>
                            </div>
                            <div class="checkout__payment__detail">Pay with cash upon delivery
                                <div class="triangle-box">
                                    <div class="triangle"></div>
                                </div>
                            </div>
                            <div class="form-group--block">
                                <input disabled class="form-check-input" type="checkbox" id="checkboxPaypal" value="paypal">
                                <label class="label-checkbox" for="checkboxPaypal"><b class="text-heading">eSewa </b> <a href="#">What is eSewa?</a></label>
                            </div>
                        </div>
                        <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#" class="text-success">privacy policy.</a></p>
                        <div class="form-group--block">
                            <input class="form-check-input" value="accept" type="checkbox" id="checkboxAgree" v-model="terms" >
                            <label class="label-checkbox" for="checkboxAgree"><b class="text-heading">I have read and agree to the website
                                    <a href="#" class="text-success">terms and conditions </a><span>*</span></b></label>
                        </div><button  class="checkout__order" @click.prevent="placeOrder" >Place an order</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </section>
</template>
<script>
export default {
    data(){
        return{
            errors:[],
            count:0,
            cart_products:{},
            terms:false,
            grand_total:0,
            payment_value:'cash on delivery',
            payment_type:true,
            payment_status:"unpaid",
            address:{
                name:'',
                email:'',
                phone:'',
                address:'',
                landmark:'',
                phone:'',
                email:'',
                order_note:'',

            }
        }
    },
    methods:{
    total(subtotal,totalShippingCost,totalTaxCost){
      this.grand_total = subtotal+totalShippingCost+totalTaxCost;
      return subtotal+totalShippingCost+totalTaxCost;
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
        placeOrder(){
            if(!this.terms){
                this.$toast.error('Accept Terms and condition', 'error', {
                      timeout: 3000,
                      position: "topRight",
                  });
                return;
            }
            axios.post(`/customer/place/order`,{
                payment_value : this.payment_value,
                payment_type : this.payment_type,
                payment_status : this.payment_status,
                terms: this.terms,
                shipping_address: this.address,
                grand_total: this.grand_total,
            }).then(response=>{
                
                this.$toast.success(response.data.message, 'success', {
                    timeout: 3000,
                    position: "topRight",
                });
                window.location.href = '/customer/order';
            }).catch(error=>{
                this.errors = error.response.data.errors;
                this.$toast.error(error.response.data.message, 'error', {
                      timeout: 3000,
                      position: "topRight",
                  });
               
            })
        }
     },
     created(){
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
}
</script>