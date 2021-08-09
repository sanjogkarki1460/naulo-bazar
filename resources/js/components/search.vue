<template>
  <div class="header-inner__center">
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="header-search-select">
          <span class="current">All<i class="icon-chevron-down"></i></span>
          <ul class="list">
            <li class="category-option active" data-value="option">
              <a href="javascript:void(0);">All</a>
            </li>
            <li class="category-option" v-for="category in categories"
                :key="category.id" @click="getSlug(category.slug)" >
              <a  @click="getSlug(category.slug)">{{category.name}}</a>
            </li>
          </ul>
        </div>
        <i class="icon-magnifier search"></i>
      </div>
      <input  v-model="keyword" 
        class="form-control input-search"
        placeholder="I'm searchching for..."
      />
      <div class="input-group-append">
        <button @click="search" class="btn">Search</button>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
      
      data(){
          return{
              keyword:'',
              category_name:'',
              slug:'',
              categories:[],
          }
      },
      methods:{
          search(){
              window.location.href = '/search/?category='+this.slug+'&keyword='+ this.keyword;
          },
          getCategory() {
            axios
                .get(`/get/all/category`)
                .then((response) => {
                this.categories = response.data;
                })
                .catch();
            },
            getSlug(slug){
                this.slug =slug;
            }
      },
      created(){
        this.getCategory();
      }
  };
</script>