<template>
  <div>
    <div class="store__perpage" v-if="count > 0">
      <p class="result">
        <span>{{ total_product }}</span
        >Products Found
      </p>
      <p class="text-right">
        page <input type="text" :value="products.current_page" disabled />of
        {{ products.last_page }}
      </p>
    </div>
    <div class="viewtype--block" v-if="count>18">
      <div class="viewtype__select">
        <span class="text">Sorting: </span>
        <div class="select">
          <select v-model="sort" @change="filter" name="state">
            <option value="4">Old to recent</option>
            <option value="3">Recent to old</option>
            <option value="1">Price high to low</option>
            <option value="2">Price low to high</option>
          </select>
        </div>
        <div class="type">
          <span class="active"><i class="icon-icons"></i></span>
          <!-- <span><i class="icon-icons2"></i></span> -->
          <span><i class="icon-list4"></i></span>
        </div>
      </div>
    </div>
    <div class="store__product">
      <div class="row m-0">
        <div
          class="col-6 col-md-4 col-lg-3 p-0"
          v-for="product in products.data"
          :key="product.id"
        >
          <div class="ps-product--standard">
            <a :href="`/product/detail/${product.slug}`"
              ><img
                class="ps-product__thumbnail"
                :src="product.thumbnail"
                alt="alt"
            /></a>
            <wishlist :product="product"></wishlist>
            <span v-if="product.discount">
              <span
                class="ps-badge ps-product__offbadge"
                v-if="product.discount_type == 'amount'"
                >Rs {{ product.discount }} Off</span
              >
              <span class="ps-badge ps-product__offbadge" v-else
                >{{ product.discount }}% Off</span
              >
            </span>
            <div class="ps-product__content">
              <p class="ps-product__type">
                <i class="icon-store"></i>{{ user.name }}
              </p>
              <h5>
                <a
                  class="ps-product__name"
                  :href="`/product/detail/${product.slug}`"
                  >{{ product.name }}</a
                >
              </h5>
              <p class="ps-product__unit">{{ product.unit }}</p>
              <div class="ps-product__rating">
                <star-rating
                  :increment="0.2"
                  :star-size="15"
                  :read-only="true"
                  :show-rating="false"
                  :rating="product.rating"
                ></star-rating>
                <!-- <span>({{product.reviews.length}})</span> -->
              </div>
              <p class="ps-product-price-block">
                <span class="ps-product__sale"
                  >Rs{{ product.selling_price }}</span
                ><span class="ps-product__price" v-if="product.discount"
                  >Rs{{ product.unit_price }}</span
                >
              </p>
            </div>
            <cart :product="product"></cart>
          </div>
        </div>
      </div>
    </div>
    <div class="ps-pagination blog--pagination">
      <pagination
        :data="products"
        @pagination-change-page="getProduct"
      ></pagination>
    </div>
  </div>
</template>
<script>
Vue.component("pagination", require("laravel-vue-pagination"));
export default {
  props: ["user"],
  data() {
    return {
      page: 1,
      sort: 3,
      count: 0,
      total_product:0,
      products: {},
    };
  },
  methods: {
    getProduct(page) {
      axios
        .get(`/seller/product/${this.user.id}/?page=${page}`, {
          params: { sort: this.sort },
        })
        .then((response) => {
          console.log(response.data);
          this.products = response.data.product;
          this.count = this.products.data.length;
          this.total_product = response.data.total_product;
        })
        .catch();
    },
    filter() {
      this.getProduct();
    },
  },
  created() {
    this.getProduct();
  },
};
</script>