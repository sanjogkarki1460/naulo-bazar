<template>
    <div class="container">
        <div class="recommendations__header">
            <h3 class="recommendations__title">Recommendations</h3>
        </div>
        <div class="recommendations__content">
            <div class="owl-carousel" data-owl-auto="true" data-owl-loop="true" data-owl-speed="15000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="5" data-owl-duration="1000" data-owl-mousedrag="on">
                <div v-for="product in recommended" :key="product.id" class="ps-recommendation__product">
                    <div class="ps-product--standard"><a href="product_details.html"><img class="ps-product__thumbnail" src="assets/img/products/06-softdrinks-teacoffee/06_5a.jpg" alt="alt" /></a><a class="ps-product__expand" href="javascript:void(0);"><i class="icon-heart"></i></a><span class="ps-badge ps-product__offbadge">25% Off </span>
                        <div class="ps-product__content">
                            <p class="ps-product__type"><i class="icon-store"></i>Kinaraa Store</p>
                            <h5><a class="ps-product__name" href="product_details.html">Michelob Ultra Cans</a></h5>
                            <p class="ps-product__unit">250g</p>
                            <div class="ps-product__rating">
                                <select class="rating-stars">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4" selected="selected">4</option>
                                    <option value="5">5</option>
                                </select><span>(2)</span>
                            </div>
                            <p class="ps-product-price-block"><span class="ps-product__sale">Rs15.99</span><span class="ps-product__price">Rs20.90</span>
                            </p>
                        </div>
                        <div class="ps-product__footer">
                            <div class="def-number-input number-input safari_only">
                                <button class="minus" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="icon-minus"></i></button>
                                <input class="quantity" min="0" name="quantity" value="1" type="number" />
                                <button class="plus" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="icon-plus"></i></button>
                            </div>
                            <div class="ps-product__total">Total: <span>Rs15.99</span>
                            </div>
                            <button class="ps-product__addcart" ><i class="icon-cart"></i>Add to cart</button>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</template>
<script>
export default{
  data(){
    return{
      recommended:[],

    }
  },
  methods:{
    getData(){
      axios.get(`/homepage/data`)
           .then(response=>{
              this.recommended = response.data;
              
           })
           .catch();
    }
  },
  created(){
    this.getData();
  },

}
</script>