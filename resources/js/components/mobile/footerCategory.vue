<template>
    <div class="ps-footer--categories">
            <div class="categories__list" v-for="category in categories" :key="category.id"><b>{{category.name}}: </b>
                <ul class="menu--vertical">
                    <li v-for="subcategory in category.subcategories"
                :key="subcategory.id" class="menu-item"> <a :href="`/subcategory/${subcategory.slug}`">{{subcategory.name}}</a>
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