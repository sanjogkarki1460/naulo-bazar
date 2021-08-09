<template>
    <a class="button-icon icon-md" href="/customer/wishlist">
        <i class="icon-heart text-white"></i><span class="badge bg-warning" v-if="count>0" >{{count}}</span>
    </a>
</template>
<script>
export default {
    data(){
        return{
            count:null,
        }
    },
    methods:{
        wishlistCount(){
            axios.get(`/customer/wishlist/count`)
                 .then(response=>{
                     this.count = response.data;
                 })
                 .catch();
        }
    },
    created(){
        EventBus.$on('wishlist', data=> {
             this.wishlistCount();    
        });
        this.wishlistCount();
    }
}
</script>