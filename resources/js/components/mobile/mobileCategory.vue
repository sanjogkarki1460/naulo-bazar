<template>
    <div class="ps-category--mobile">
    <div class="category__header">
        <div class="category__title">All Category</div><span class="category__close"><i class="icon-cross"></i></span>
    </div>
    <div class="category__content">
        <ul class="menu--mobile">
            
            <li class="menu-item-has-children category-item" v-for="category in categories" :key="category.id"><a :href="`/category/${category.slug}`">{{category.name}}</a><span class="sub-toggle" v-if="category.subcategories.length > 0"><i class="icon-chevron-down"></i></span>
                <ul class="sub-menu" v-if="category.subcategories.length > 0">
                    <li v-for="subcategory in category.subcategories"
                :key="subcategory.id"> <a :href="`/subcategory/${subcategory.slug}`">{{ subcategory.name }}</a>
                    </li>
                    
                </ul>
            </li>
            
        </ul>
    </div>
</div>
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