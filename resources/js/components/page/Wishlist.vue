<template>
  <div class="col-12 col-lg-9">
    <div class="product_tbl">
      <table  class="table">
        <thead class="wishlist__thead">
          <tr>
            <th scope="col"></th>
            <th scope="col">Product Name</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Stock Status</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody v-if="wishlists_data.length>0"  class="wishlist__tbody">
         
          <tr v-for="(wishlist,index) in wishlists_data" :key="wishlist.id">
            <td>
              <div  class="wishlist__trash" ><i style="cursor:pointer" @click="remove(index,wishlist.product.id)" class="icon-trash2"></i></div>
            </td>
            <td>
              <div class="ps-product--vertical">
                <a :href="`/product/detail/${wishlist.product.slug}`"
                  ><img
                    class="ps-product__thumbnail"
                    :src="wishlist.product.thumbnail"
                    alt="alt"
                /></a>
                <div class="ps-product__content">
                  <h5>
                    <a
                      class="ps-product__name"
                      :href="`/product/detail/${wishlist.product.slug}`"
                      >{{wishlist.product.name}}</a
                    >
                  </h5>
                  <p class="ps-product__unit">{{wishlist.product.unit}}</p>
                </div>
              </div>
            </td>
            <td>
              <span class="ps-product__price"
                >Rs{{wishlist.product.selling_price}}</span
              >
            </td>
            <td>
              
              <span v-if="wishlist.product.current_stock>0" class="ps-product__instock">In stock</span>
              
              <span v-else style="color: red" class="ps-product__instock"
                >Out of stock</span>
              
            </td>
            <td>
              <button class="btn wishlist__btn add-cart" @click="addToCart(wishlist.product.id)">
                <i class="icon-cart"></i>Add to cart
              </button>
            </td>
          </tr>
          
        </tbody>
        <tbody v-else>
          <tr>
            <td>No product found</td>
          </tr>
        </tbody>
        
      </table>
      
    </div>
  </div>
</template>
<script>
export default {
  props: ["wishlists"],
  data(){
      return{
          wishlists_data:{},
      }
  },
  methods:{
    addToCart(id){
            axios.post(`/customer/addToCart`,{
               id : id,
            })
            .then(response=>{
               this.$toast.success(response.data.message, 'success', {
                   timeout: 3000,
                   position: "topRight",
               });
               EventBus.$emit('cart','check');
            })
            .catch()
        },
      remove(index,id){   
          axios.post(`/add_to_wishlist/${id}`)
                 .then(response=>{
                    this.wishlists_data.splice(index, 1);
                    this.$toast.success(response.data, 'success', {
                      timeout: 3000,
                      position: "topRight",
                  });
            }).catch();
            EventBus.$emit('wishlist','check');
           //return this.wishlists;
      }
  },
  mounted(){
      this.wishlists_data = this.wishlists;
      
  }
};
</script>