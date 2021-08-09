<template>
  <div class="row">
    <div class="cart-product">
      <div class="ps-product--mini-cart">
        <a :href="`/product/detail/${cart.product.slug}`"
          ><img
            class="ps-product__thumbnail"
            :src="cart.product.thumbnail"
            alt="alt"
        /></a>
        <div class="ps-product__content">
          <h5>
            <a
              class="ps-product__name"
              :href="`/product/detail/${cart.product.slug}`"
              >{{ cart.product.name }}</a
            >
          </h5>
          <p class="ps-product__unit">{{ cart.product.unit }}</p>
          <p class="ps-product__soldby">
            Sold by
            <span
              ><a :href="`/seller/${cart.product.user.id}`">
                {{ cart.product.user.name }}
              </a></span
            >
          </p>
          <p class="ps-product__meta">
            Price:
            <span class="ps-product__price">Rs {{ cart.price }}</span>
          </p>
          <div class="def-number-input number-input safari_only">
            <button
              class="minus"
              @click="decrement"
            >
              <i class="icon-minus"></i>
            </button>
            <input
              class="quantity"
              min="0"
              name="quantity"
              @change="updateCart"
              v-model="qty"
              type="number"
            />
            <button
              class="plus"
              @click="increment"
            >
              <i class="icon-plus"></i>
            </button>
          </div>
          <span class="ps-product__total"
            >Total:
            <span>Rs. {{ getTotal }} </span></span
          >
        </div>
        <div class="ps-product__remove">
          <i class="icon-trash2"></i>
        </div>
      </div>
    </div>
    <div class="cart-price">
      <span class="ps-product__price">Rs {{ cart.price }}</span>
    </div>
    <div class="cart-quantity">
      <div class="def-number-input number-input safari_only">
        <button
          class="minus"
          @click="decrement"
        >
          <i class="icon-minus"></i>
        </button>
        <input
          class="quantity"
          min="0"
          name="quantity"
          v-model="qty"
          @change="updateCart"
          type="number"
        />
        <button
          class="plus"
          @click="increment"
        >
          <i class="icon-plus"></i>
        </button>
      </div>
    </div>
   
    <div class="cart-total">
      <span class="ps-product__total"
        >Rs {{ getTotal }}
      </span>
    </div>
    <div class="cart-action">
      <i class="icon-trash2" @click="deleteCartProduct(cart.id)"></i>
    </div>
  </div>
</template>
<script>
export default {
  props: ["cart"],
  data() {
    return {
      qty:0,
    };
  },
  methods: {
    deleteCartProduct(id) {
      axios
        .delete(`/customer/deleteCart/${id}`)
        .then((response) => {
          this.$toast.success(response.data.message, "success", {
            timeout: 3000,
            position: "topRight",
          });
          EventBus.$emit("cart", "check");
          
        })
        .catch((error) => {
          this.$toast.error(error.response.data.message, "Error", {
            timeout: 3000,
            position: "topRight",
          });
        });
    },
    increment(){
        if(this.cart.product.current_stock >= this.qty+1){
           this.qty++;
           this.updateCartQuantity();
        }
        return;
    },

    decrement(){
        if(this.qty >1){
           this.qty--;
           this.updateCartQuantity();
        }
        return;
    },
    
    updateCart(){
        this.updateCartQuantity();
    },
    updateCartQuantity(){
        axios.post(`/customer/update/cart`,{
            id: this.cart.id,
            product_id : this.cart.product_id,
            quantity : this.qty,
        }).then(response=>{
            console.log('cart updated succefully');
        }).catch(error=>{
            this.$toast.info(error.response.data.message, 'message', {
                   timeout: 3000,
                   position: "topRight",
            });
            
        });
    }
  },
  mounted(){
      this.qty = this.cart.quantity
  },
  computed:{
      getTotal(){
         return  this.cart.price * this.qty
      }
  },
  
};
</script>