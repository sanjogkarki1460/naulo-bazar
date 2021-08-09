<template>
    <div>
        <section class="section--product-type">
        <div class="container">
            <div class="product__detail">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <div class="ps-product--detail">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="ps-product__variants">
                                        <div class="ps-product__gallery">
                                            <div v-for="image in product.main_image" :key="image" class="ps-gallery__item active"><img :src="image" alt="alt" /></div>
                                            
                                        </div>
                                        <div class="ps-product__thumbnail">
                                            <div class="ps-product__zoom"><img id="ps-product-zoom" :src="product.main_image[0]" alt="alt" />
                                                <ul class="ps-gallery--poster" id="ps-lightgallery-videos" data-video-url="#">
                                                    <li data-html="#video-play"><span></span><i class="fa fa-play-circle"></i></li>
                                                </ul>
                                            </div>
                                            <div style="display:none;" id="video-play">
                                                <video class="lg-video-object lg-html5" controls preload="none">
                                                    <source src="#" type="video/mp4" />Your browser does not support HTML5 video.
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">

                                    <div class="product__header">
                                        <h3 class="product__name">{{product.name}}</h3>
                                        
                                        <div class="row">
                                            <div class="col-12 col-lg-12 product__code">
                                                <star-rating :increment="0.2" :star-size="15" :read-only="true" :show-rating="false" :rating="product.rating"></star-rating><span class="product__review">{{reviews.length}} Customer Review</span><span class="product__id">SKU: <span>#VEG20938</span></span>
                                            </div>

                                        </div>
                                    </div>
                                    

                                    <div class="ps-product__sale"><span class="price-sale">Rs {{product.selling_price}}</span><span class="price">Rs {{product.unit_price}}</span>
                                    <span v-if="product.discount" class="ps-product__off"> <span class="ps-product__off" v-if="product.discount_type == 'amount'">Rs. </span>{{product.discount}} <span class="ps-product__off" v-if="product.discount_type != 'amount'">%</span> Off</span>
                                    </div>
                                    <div class="ps-product__unit">{{product.unit}}</div>
                                    <div class="ps-product__avai " :class="product.current_stock > 0 ?'alert__success':'alert__error'">Availability: <span>
                                        <span v-if="product.current_stock > 0"> {{product.current_stock}} in</span> 
                                        <span v-else> out of </span> 
                                         stock</span>
                                    </div>
                                    <div class="ps-product__info">
                                        <ul class="ps-list--rectangle">
                                            <li> <span><i class="icon-square"></i></span>Type: Drinks</li>
                                            <li> <span><i class="icon-square"></i></span>MFG: Jan 4.2021</li>
                                            <li> <span><i class="icon-square"></i></span>LIFE: 90 days</li>
                                        </ul>
                                    </div>
                                    <div class="ps-product__shopping">
                                        <div class="ps-product__quantity">
                                            <label>Quantity: </label>
                                            <div class="def-number-input number-input safari_only">
                                                <button class="minus" @click="decrement"><i class="icon-minus"></i></button>
                                                <input @keyup="checkQuantity" v-model="qty" class="quantity" min="0" name="quantity" value="1" type="number" />
                                                <button class="plus" @click="increment"><i class="icon-plus"></i></button>
                                            </div>
                                        </div><a class="ps-product__addcart ps-button" @click="addToCart"><i class="icon-cart"></i>Add to cart</a><a class="ps-product__icon" href="/customer/wishlist">
                                            <wishlist :product="product"></wishlist></a><a class="ps-product__icon"><i class="icon-share"></i></a>
                                    </div>

                                    <div class="ps-product__footer"><a class="ps-product__shop" :href="`/seller/${product.user_id}`"><i class="icon-store"></i><span>Store</span></a><a class="ps-product__addcart ps-button" @click="addToCart"><i class="icon-cart"></i>Add to cart</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="ps-product--extention">
                            <div class="extention__block">
                                <div class="extention__item">
                                    <div class="extention__icon"><i class="icon-truck"></i></div>
                                    <div class="extention__content"> <b class="text-black">Free Shipping </b>apply to all orders over <span class="text-success">Rs1000</span></div>
                                </div>
                            </div>
                            <div class="extention__block">
                                <div class="extention__item">
                                    <div class="extention__icon"><i class="icon-leaf"></i></div>
                                    <div class="extention__content">Guranteed <b class="text-black">100% Organic </b>from natural farmas </div>
                                </div>
                            </div>
                            <div class="extention__block">
                                <div class="extention__item border-none">
                                    <div class="extention__icon"><i class="icon-repeat-one2"></i></div>
                                    <div class="extention__content"> <b class="text-black">1 Day Returns </b>if you change your mind</div>
                                </div>
                            </div>
                            <div class="extention__block extention__contact">
                                <p> <span class="text-black">Hotline Order: </span>Free 7:00-21:30</p>
                                <h4 class="extention__phone">+977-9810099062</h4>
                                <h4 class="extention__phone">+977-01-4800733</h4>
                            </div>
                            <p class="extention__footer">Become a Vendor? <a href="/seller/register">Register now</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product__content">
                <ul class="nav nav-pills" role="tablist" id="productTabDetail">
                    <li class="nav-item"><a class="nav-link active" id="description-tab" data-toggle="tab" href="#description-content" role="tab" aria-controls="description-content" aria-selected="true">Description</a></li>

                    <li class="nav-item"><a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews-content" role="tab" aria-controls="reviews-content" aria-selected="false">Reviews({{reviews.length}})</a></li>
                   
                    <li class="nav-item"><a class="nav-link" id="vendor-tab" data-toggle="tab" href="#vendor-content" role="tab" aria-controls="vendor-content" aria-selected="false">Vendor Info</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="description-content" role="tabpanel" aria-labelledby="description-tab">
                        {{product.description}}
                    </div>
                    
                    <div class="tab-pane fade" id="reviews-content" role="tabpanel" aria-labelledby="reviews-tab">
                        <div class="ps-product--reviews">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="review__box">
                                        <div class="product__rate">{{product.rating}}</div>
                                        <star-rating active-color="#ff7200" :increment="0.2" :star-size="25" :read-only="true" :show-rating="false" :rating="product.rating"></star-rating>
                                        <p>Avg. Star Rating: <b class="text-black">({{reviews.length}} reviews)</b></p>
                                        <div class="review__progress">
                                            <div class="progress-item" v-for="(percent,index) in reviews_percent" :key="index" ><span class="star">{{index}} Stars</span>
                                                
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar" :style="`width: ${percent}%`" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div><span class="percent">{{percent}}%</span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="review__title">Add A Review</div>
                                    <p class="mb-0">Required fields are marked <span class="text-danger">*</span></p>
                                    
                                        <div class="form-row">
                                            <div class="col-12 form-group--block">
                                                <div class="input__rating">
                                                    <label>Your rating: <span>*</span> </label>
                                                    <small style="color:red" v-if="errors.rating">{{errors.rating[0]}}</small>
                                                    <star-rating  :star-size="20" rating="" :show-rating="false" v-model="rating"></star-rating>
                                                </div>
                                            </div>
                                            <div class="col-12 form-group--block">
                                                <label>Review: <span>*</span></label>
                                                <textarea v-model="comment" class="form-control"></textarea>
                                                <small style="color:red" v-if="errors.comment">{{errors.comment[0]}}</small>
                                            </div>
                                            
                                            
                                            <div class="col-12 form-group--block">
                                                <button class="btn ps-button ps-btn-submit" @click="postReviews(product.id)">Submit Review</button>
                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
                            <div class="ps--comments">
                                <h5 class="comment__title">{{reviews.length}} Comments </h5>
                                <ul class="comment__list">
                                    <li v-for="review in reviews" :key="review.id" class="comment__item">
                                        <div class="item__avatar"><img :src="review.user.user_avatar" alt="alt" /></div>
                                        <div class="item__content">
                                            <div class="item__name">{{review.user.name}}</div>
                                            <div class="item__date">- {{review.created_date}}</div>
                                            <div class="item__check"> <i class="icon-checkmark-circle"></i>Verified Purchase</div>
                                             <star-rating :increment="0.2" :star-size="15" :read-only="true" :show-rating="false" :rating="review.rating"></star-rating>
                                            <p class="item__des">{{review.comment}}</p>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="vendor-content" role="tabpanel" aria-labelledby="vendor-tab">
                        <div class="ps-product__category">
                            <ul>
                                <li v-if="product.user.shop">Shop: <a :href='`/seller/${product.user_id}`' class='text-success'>{{product.user.shop.name}}</a></li>
                                <li>Vendor: <a :href='`/seller/${product.user_id}`' class='text-success'>{{product.user.name}}</a></li>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    </div>
</template>
<script>
export default {
    props:['product','images'],
    data(){
        return {
            qty:1,
            rating:null,
            reviews:{},
            comment:'',
            errors:{},
            reviews_percent:{},
        }
    },
    methods:{
        addToCart(){
            axios.post(`/customer/addToCart`,{
               id : this.product.id,
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
        },
        postReviews(id){
            axios.post(`/add/review/${id}`,{
                comment:this.comment,
                rating: this.rating,
            }).then(response=>{
                this.comment='';
                this.$toast.success(response.data, 'Success', {
                    timeout: 5000,
                    position: "topRight",
                });
                this.getReviews(id);
            }).catch(error=>{
                this.errors = error.response.data.errors;
                if(error.response.status ==401){
                    this.$toast.error('Please login first', 'Message', {
                    timeout: 5000,
                    position: "topRight",
                });
                }
            });
        },
        getReviews(id){
            axios.get(`/review/${id}`)
            .then(response=>{
                this.reviews = response.data.reviews;
                this.reviews_percent = response.data.rating_precent;
                
            })
            .catch();
        }
    },
    created(){
        this.reviews = this.product.reviews;
        this.getReviews(this.product.id);
    }
}
</script>