<template>
  <div>
    <div class="form-row">
      <div class="col-12 col-lg-6 form-group--block">
        <label>Country:</label>
        <input class="form-control" :class="errors.country?'is-invalid':''" v-model="country" type="text" placeholder="Eg: Nepal" />
        <small v-if="errors.country" style="color:red">{{errors.country[0]}}</small>
      </div>
      <div class="col-12 col-lg-6 form-group--block">
        <label>City:</label>
        <input class="form-control" :class="errors.city?'is-invalid':''" v-model="city"  type="text" placeholder="Eg: kathmandu" />
        <small v-if="errors.city" style="color:red">{{errors.city[0]}}</small>
      </div>
      <div class="col-12 form-group--block">
        <label>Phone:</label>
        <input class="form-control"  :class="errors.phone?'is-invalid':''" type="number" v-model="phone" placeholder="Eg: 9844535675" required />
        <small v-if="errors.phone" style="color:red">{{errors.phone[0]}}</small>
      </div>
      <div class="col-12 col-lg-12 form-group--block">
        <label>Home Region:</label>
        <input
          class="form-control"
          type="text"
          v-model="home_region"
          :class="errors.home_region?'is-invalid':''"
          placeholder="Eg:Bagmati, Inside Ring Road, Kathmandu Nepal"
        />
        <small v-if="errors.home_region" style="color:red">{{errors.home_region[0]}}</small>
      </div>
      <div class="col-12 col-lg-12 form-group--block">
        <label>Home Address:</label>
        <input
          class="form-control"
          type="text"
          v-model="address"
          :class="errors.address?'is-invalid':''"
          placeholder="Eg:Chabahil, Kathmandu, Nepal"
        />
        <small v-if="errors.address" style="color:red">{{errors.address[0]}}</small>
      </div>
      <div class="col-12 col-lg-12 form-group--block">
        <label>Office Region:</label>
        <input
          class="form-control"
          type="text"
          v-model="office_region"
          :class="errors.office_region?'is-invalid':''"
          placeholder="Eg:Bagmati - Kathmandu Outside Ring Road - Budhanilkantha - Kapan Area"
        />
        <small v-if="errors.office_region" style="color:red">{{errors.office_region[0]}}</small>
      </div>
      <div class="col-12 col-lg-12 form-group--block">
        <label>Office Address:</label>
        <input
          class="form-control"
          type="text"
          v-model="office_address"
          :class="errors.office_address?'is-invalid':''"
          placeholder="Eg:Sukedhara to Kapan Marga, Near Dhalane bridge ढलाने पूल, Kapan"
        />
        <small v-if="errors.office_address" style="color:red">{{errors.office_address[0]}}</small>
      </div>
      <div class="col-12 col-lg-12 form-group--block">
        <button v-if="action=='update'" class="btn btn-save" type="submit" @click="updateAddress">Save Changes</button>
        <button v-if="action=='insert'" class="btn btn-save" type="submit" @click="createAddress">Save Changes</button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    props:['detail','action'],
  data() {
    return {
      address:'',
      home_region:'',
      office_region:'',
      office_address:'',
      phone:'',
      country:'',
      city:'',
      errors:[],
    };
  },
  methods:{
      updateAddress(){
          axios.put(`/customer/address/update`,{
              address : this.address,
              home_region: this.home_region,
              office_region: this.office_region,
              phone : this.phone,
              country: this.country,
              city: this.city,
              office_address : this.office_address,
      }).then(response=>{
          
          this.$toast.success(response.data, 'success', {
                      timeout: 3000,
                      position: "topRight",
                  });
                  this.errors=[];
      }).catch(error=>{
          this.errors= error.response.data.errors;
      });
  }, 
    createAddress(){
          axios.post(`/customer/add/address`,{
              address : this.address,
              home_region: this.home_region,
              office_region: this.office_region,
              phone : this.phone,
              country: this.country,
              city: this.city,
              office_address : this.office_address,
      }).then(response=>{
          this.$toast.success(response.data, 'success', {
                      timeout: 3000,
                      position: "topRight",
                  });
                  this.errors=[];
                  this.action = 'update';
      }).catch(error=>{
          this.errors= error.response.data.errors;
      });
  },
 },
 created(){
      if(this.action == 'update'){
          this.address       = this.detail.address;
          this.phone         = this.detail.phone;
          this.home_region   = this.detail.home_region;
          this.office_region = this.detail.office_region;
          this.office_address = this.detail.office_address;
          this.country       = this.detail.country;
          this.city          = this.detail.city;
      }
  }
}
</script>