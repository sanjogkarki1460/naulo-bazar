<template>
    <a @click="addToWishlist" class="ps-product__expand" href="javascript:void(0);">
        <i class="icon-heart"></i>
    </a>
</template>
<script>

export default {
    props:['product'],
    data(){
        return {
        }
    },
    methods:{
        addToWishlist(){
            axios.post(`/add_to_wishlist/${this.product.id}`)
                 .then(response=>{
                     this.$toast.success(response.data, 'success', {
                    timeout: 3000,
                    position: "topRight",
                });
            }).catch(error=>{
                 this.$toast.error(error.response.data, 'error', {
                    timeout: 3000,
                    position: "topRight",
                });
            }
            );
            EventBus.$emit('wishlist','check');
        }
    },
    
    
}
</script>
<style scoped>
    
</style>