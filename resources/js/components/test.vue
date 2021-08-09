<template>
    <div>
        <p>quantity : {{quantity}} <button @click="increment">+</button></p>
        <p>price : {{price}}</p>
        <p>total : {{total}}</p>
    </div>
</template>
<script>
export default {
    data(){
        return{
            quantity:5,
            price:100,
            total:100,
        }
    },
    methods:{
        calculate(){
            this.total = this.quantity* this.price
        },
        increment(){
            this.quantity++;
            this.calculate();
        }
        
    },
    created(){
        this.calculate();
    }
}
</script>