<template>
     <a class="ps-product__expand" href="javascript:void(0);" @click="triger" data-toggle="modal" data-target="#popupQuickview"><i class="icon-expand"></i></a>
</template>
<script>
export default {
    props:['product'],
    methods:{
        triger(){
            
            EventBus.$emit('show-model', this.product);
        }
    },
    
}
</script>