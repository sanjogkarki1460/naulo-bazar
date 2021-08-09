<template>
    <section class="section-shop shop-categories--default">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="ps-shop--sidebar">
                        <div class="sidebar__sort">
                            <div class="sidebar__block open">
                                <div class="sidebar__title">BY BRANDS<span class="shop-widget-toggle"><i class="icon-minus"></i></span></div>
                                <form action="#">
                                    <div class="input-group">
                                        <input class="form-control" type="text" v-model="search" placeholder="Search brand...">
                                        <div class="input-group-append"><i class="icon-magnifier"></i></div>
                                    </div>
                                </form>
                                <div class="brand__content">
                                    <ul>
                                        <li v-for="(brand,index) in all_brands" :key="index">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" v-model="product_brand" :value="brand.id">
                                                <label for="checkbox0">
                                                    <span>{{brand.name}}</span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar__block open">
                                <div class="sidebar__title">BY PRICE<span class="shop-widget-toggle"><i class="icon-minus"></i></span></div>
                                <div class="block__content">
                                    <div class="block__input">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Rs</span></div>
                                            <input class="form-control" v-model="price[0]" type="text" id="input-with-keypress-0">
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Rs</span></div>
                                            <input class="form-control" v-model="price[1]" type="text" id="input-with-keypress-1">
                                        </div>
                                        <button @click="apply_filter">Go</button>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="sidebar__block open">
                                <div class="sidebar__title">AVG. REVIEW<span class="shop-widget-toggle"><i class="icon-minus"></i></span></div>
                                <div class="block__content">
                                    <ul>
                                        
                                        <li v-for="n  in 5 " :key="n">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="avg5" value="">
                                               <label>
                                                <star-rating :star-size="15" :read-only="true" :show-rating="false" :rating="n"></star-rating>
                                               
                                               </label>
                                                & Up
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                            <div class="sidebar__block open">
                                <div class="sidebar__title">SOLD BY<span class="shop-widget-toggle"><i class="icon-minus"></i></span></div>
                                <div class="block__content">
                                    <ul>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" v-model="user_type" type="checkbox" id="sold0" value="admin">
                                                <label for="sold0">Onestore</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" v-model="user_type" type="checkbox" id="sold1" value="vendor">
                                                <label for="sold1">All Vendors</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            
                        </div>
                        <button @click="apply_filter"> apply filter</button>
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="result__header">
                        <h4 class="title"> {{total_product}} <span>Product Found</span></h4>
                        <div class="page">page
                            <input type="text" :value="products.current_page" disabled> of {{products.last_page}}  
                        </div>
                    </div>
                    <div class="result__sort mt-5">
                        <div class="viewtype--block">
                            <div class="viewtype__sortby">
                                <div class="select">
                                    <select v-model="sort" @change="apply_filter" name="state">
                                        <option value="4">Old to recent</option>
                                        <option value="3">Recent to old</option>
                                        <option value="1">Price high to low</option>
                                        <option value="2">Price low to high</option>
                                    </select>
                                </div>
                            </div>
                            <div class="viewtype__select"> <span class="text">View: </span>
                                <div class="select" >
                                    <select class="select2" @change="pageValue" v-model="perPage">
                                        <option value="25" >25 per page</option>
                                        <option value="12" selected>12 per page</option>
                                        <option value="5">5 per page</option>
                                        
                                    </select>
                                </div>
                                
                                <div class="type"><a href="shop-categories.html"><span class="active"><i class="icon-icons"></i></span></a><a href="shop-view-extended.html"><span><i class="icon-grid3"></i></span></a><a href="shop-view-listing.html"><span><i class="icon-list4"></i></span></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="result__header mobile">
                        <h4 class="title">{{total_product}}<span>Product Found</span></h4>
                    </div>
                    <div class="result__content mt-4">
                        <div class="section-shop--grid">
                            <div class="row m-0">
                                <div v-for="product in products.data" :key="product.id" class="col-6 col-md-4 col-lg-3 p-0">
                                    <div class="ps-product--standard"><a :href="`/product/detail/${product.slug}`">  <img class="ps-product__thumbnail" :src="product.thumbnail" alt="alt" /></a>
                                    <wishlist :product="product"></wishlist>
                                    <!-- <span v-if="product.discount">
                                        <span
                                            class="ps-badge ps-product__offbadge"
                                            v-if="product.discount_type == 'amount'"
                                            >Rs {{ product.discount }} Off</span
                                        >
                                        <span class="ps-badge ps-product__offbadge" v-else
                                            >{{ product.discount }}% Off</span
                                        >
                                        </span> -->
                                        <div class="ps-product__content">
                                            <p class="ps-product__type"><i class="icon-store"></i>{{product.user.name}}</p>
                                            <h5><a class="ps-product__name" :href="`/product/detail/${product.slug}`">{{product.name}}</a></h5>
                                            <p class="ps-product__unit">300g</p>
                                             <star-rating :star-size="15" :show-rating="false" :rating="product.rating"></star-rating>
                                            <p class="ps-product-price-block">
                                                <span class="ps-product__sale"
                                                    >Rs{{ product.selling_price }}</span
                                                    >
                                                    <span class="ps-product__price" v-if="product.discount"
                                                    >Rs{{ product.unit_price }}</span>
                                            
                                            </p>
                                        </div>
                                        <cart :product="product"></cart>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="ps-pagination blog--pagination">
                            <ul class="pagination">
                                <pagination :data="products" @pagination-change-page="getProduct"></pagination>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>
<script>
Vue.component('pagination', require('laravel-vue-pagination'));
export default {
    props:['brands','category','keyword'],
    data(){
        return{
            sort: 3,
            page:1,
            products:{},
            total_product:0,
            perPage:'25',
            search:'',
            product_brand:[],
            user_type:[],
            price:[],
        }
    },
    methods:{
        apply_filter(){
            this.getProduct();
        },

        getProduct(page){
            axios.get(`/search/result/?page= ${page}`,{
                params:{
                    per_page : this.perPage,
                    brand_id : this.product_brand,
                    sort : this.sort,
                    user_type : this.user_type,
                    price : this.price,
                    category: this.category,
                    keyword : this.keyword,
                }
            })
                 .then(response=>{
                    this.products = response.data.products;
                    this.total_product = response.data.total_product;
                 })
                 .catch();
        },
        pageValue(){
            this.getProduct();
        }
    },
    computed:{
      all_brands(){
          return this.brands.filter((data)=>{
            return data.name.toLowerCase().match(this.search);
          })
        
      }
    },
    created(){
        this.getProduct();
    }
}
</script>
<style scoped>
    a{
        position:relative;
        z-index: 200;
    }
</style>