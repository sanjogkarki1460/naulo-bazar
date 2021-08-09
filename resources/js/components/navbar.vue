<template>
  <ul class="menu menu-dark">
    <li class="menu-item-has-children has-mega-menu">
      <a class="nav-link" href="javascript:void(0);">
        <i class="icon-text-align-left text-white mr-3"></i>Categories </a
      ><span class="sub-toggle"><i class="icon-chevron-down"></i></span>
      <div class="mega-menu mega-menu-category">
        <ul class="menu--mobile">
          <!-- <li class="category-item"> <a href="shop-categories.html">Top Promotions</a>
                                        </li> -->

          <li
            v-for="category in categories"
            :key="category.id"
            class="menu-item-has-children category-item"
          >
            <a :href="`/category/${category.slug}`">{{ category.name }}</a
            ><span class="sub-toggle">
              <i
                v-if="category.subcategories.length > 0"
                class="icon-chevron-down"
              ></i
            ></span>
            <ul class="sub-menu" v-if="category.subcategories.length > 0">
              <li
                v-for="subcategory in category.subcategories"
                :key="subcategory.id"
              >
                <a :href="`/subcategory/${subcategory.slug}`">{{ subcategory.name }}</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </li>
  </ul>
</template>
<script>
export default {
  data() {
    return {
      categories: {},
    };
  },
  methods: {
    getCategory() {
      axios
        .get(`/get/all/category`)
        .then((response) => {
          this.categories = response.data;
        })
        .catch();
    },
  },

  created() {
    this.getCategory();
  },
};
</script>