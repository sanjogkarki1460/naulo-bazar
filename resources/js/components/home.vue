<template>
  <div>


    

    
       
    <!-- <top-offer></top-offer> -->

    <!-- <today-flash-sell :flash_deals="homepageData.flash_deals"></today-flash-sell> -->

    <!-- <best-selling-item></best-selling-item> -->

    <!-- <recommendation :recommended="homepageData.recommended"></recommendation> -->

    <just-for-you :products="homepageData.product"></just-for-you>
  </div>
</template>
<script>
export default{
  data(){
    return{
      homepageData:[],

    }
  },
  methods:{
    getData(){
      axios.get(`/homepage/data`)
           .then(response=>{
              this.homepageData = response.data;
              console.log(this.homepageData.recommended);
           })
           .catch();
    }
  },
  created(){
    this.getData();
  },

}
</script>
