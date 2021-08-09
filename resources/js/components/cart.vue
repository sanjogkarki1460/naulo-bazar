<template>
  <div class="ps-product__footer">
    <div class="def-number-input number-input safari_only">
      <button @click="decrement"
        class="minus"
      >
        <i class="icon-minus"></i>
      </button>
      <input class="quantity" @keyup="checkQuantity"  min="0" v-model="qty" type="number" />
      <button @click="increment"
        class="plus"
      >
        <i class="icon-plus"></i>
      </button>
    </div>
    <div class="ps-product__total">Total: <span>Rs.{{products.selling_price * qty}}</span></div>
    <button @click="addToCart" class="ps-product__addcart">
      <i class="icon-cart" ></i>Add to cart
    </button>
  </div>
</template>
<script>
export default {
    props:['product'],
    data(){
        return{
            qty:1,
            products:{},
            price:this.product.selling_price,
        }
    },
    methods:{
        addToCart(){
            axios.post(`/customer/addToCart`,{
               id : this.products.id,
               quantity: this.qty,
            })
            .then(response=>{
               this.$toast.success(response.data.message, 'success', {
                   timeout: 3000,
                   position: "topRight",
               });
               EventBus.$emit('cart','check');
            })
            .catch(error=>{
              if(error.response.status==401){
                this.$toast.error('Please login frist', 'error', {
                   timeout: 3000,
                   position: "topRight",
               });
              }
            })
        },
        calculate(){
            this.price = this.product.selling_price* this.quantity;
        },
        increment(){
            
            if(this.product.current_stock >= this.qty+1){
               this.qty++;
               console.log(typeof(this.price));
            }
            return;
            
        },
        decrement(){
            if(this.qty >1){
               this.qty--;
            }
            return;
        },
        checkQuantity(){
            if(this.qty <= 0){
                this.qty = 1;
            }else if(this.qty > this.product.current_stock){
                this.qty = this.product.current_stock;
            }else{
                return;
            }
        }
    },
    mounted(){
        this.products = this.product;
    }
}
</script>
