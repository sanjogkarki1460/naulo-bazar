<template>
  <div>
    <div class="form-row">
      <div class="col-12 col-lg-6 form-group--block">
        <label>Full Name: <span>*</span></label>
        <input :class="errors.name?'is-invalid':''"  class="form-control" type="text" v-model="name" placeholder="Full Name" />
        <small v-if="errors.name" style="color:red">{{errors.name[0]}}</small>
      </div>
      
      <div class="col-12 col-lg-6 form-group--block">
        <label>Email address: <span>*</span></label>
        <input
          class="form-control"
          type="email"
          :class="errors.email?'is-invalid':''" 
          v-model="email"
         placeholder="example@gmail.com"
        />
        <small v-if="errors.email" style="color:red">{{errors.email[0]}}</small>
      </div>
      <div class="col-12 col-lg-6 form-group--block">
        <label>Phone: <span>*</span></label>
        <input
          class="form-control"
          :class="errors.phone?'is-invalid':''" 
          type="number"
          v-model="phone"
          placeholder="Enter Your Mobile Number"
          required
        />
        <small v-if="errors.phone" style="color:red">{{errors.phone[0]}}</small>
      </div>
      <div class="col-12 col-lg-6 form-group--block">
        <label>: <span>*</span></label>
        <input :class="errors.country?'is-invalid':''"  class="form-control" type="text" v-model="country" placeholder="Country" />
        <small v-if="errors.country" style="color:red">{{errors.country[0]}}</small>
      </div>

      <div class="col-12  form-group--block">
        <label>City: <span>*</span></label>
        <input :class="errors.city?'is-invalid':''"  class="form-control" type="text" v-model="city" placeholder="Country" />
        <small v-if="errors.city" style="color:red">{{errors.city[0]}}</small>
      </div>

      <div class="col-12 form-group--block">
        <label>Home Address: <span>*</span></label>
        <input :class="errors.address?'is-invalid':''"  class="form-control" v-model="address" type="text" placeholder="Home Address" />
        <small v-if="errors.address" style="color:red">{{errors.address[0]}}</small>
      </div>
      

      <div class="col-12 col-lg-12 form-group--block">
        <button class="btn btn-save" type="submit" @click="updateProfile">Save Changes</button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    props:['user'],
    data(){
        return{
            name:'',
            email:'',
            phone:'',
            country:'',
            address:'',
            city:'',
            errors:[],
        }
    },
    methods:{
        updateProfile(){
            axios.put(`/customer/profile/update`,{
                name:this.name,
                email: this.email,
                phone:this.phone,
                country: this.country,
                city: this.city,
                address: this.address,
            })
                 .then(response=>{
                   this.$toast.success(response.data, 'success', {
                      timeout: 3000,
                      position: "topRight",
                  });
                  this.errors=[];
                 })
                 .catch(error=>{
                     this.errors = error.response.data.errors;
                 });

        }
    },
    created(){
        this.name= this.user.name;
        this.email= this.user.email;
        this.phone = this.user.phone;
        this.country = this.user.country;
        this.city = this.user.city;
        this.address = this.user.address
    }

};
</script>