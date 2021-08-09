<template>
  <div>
    <div class="form-row">
      <div class="col-12 col-lg-6 form-group--block">
        <label>Full Name: <span>*</span></label>
        <input class="form-control" :class="errors.name?'is-invalid':''" v-model="name" type="text" />
        <div v-if="errors.name" class="invalid-feedback">{{errors.name[0]}}</div>
      </div>
      
      <div class="col-12 col-lg-6 form-group--block">
        <label>Phone: <span>*</span></label>
        <input class="form-control" v-model="phone" :class="errors.phone?'is-invalid':''" type="number" />
        <div v-if="errors.phone" class="invalid-feedback">{{errors.phone[0]}}</div>
      </div>
      <div class="col-12 col-lg-6 form-group--block">
        <label>Password: <span>*</span></label>
        <input class="form-control" v-model="password" :class="errors.password?'is-invalid':''" type="password" required="" />
        <div v-if="errors.password" class="invalid-feedback">{{errors.password[0]}}</div>
      </div>
      <div class="col-12 col-lg-6 form-group--block">
        <label>Confirm Password: <span>*</span></label>
        <input class="form-control" v-model="confirm_password" :class="errors.password_confirmation?'is-invalid':''" type="password" required="" />
        <div v-if="errors.password_confirmation" class="invalid-feedback">{{errors.password_confirmation[0]}}</div>
      </div>
      <div class="col-12 col-lg-12 form-group--block">
        <label>Email: <span>*</span></label>
        <input :class="errors.email?'is-invalid':''" v-model="email" class="form-control" type="email" required="" />
        <div v-if="errors.email" class="invalid-feedback">{{errors.email[0]}}</div>
      </div>
      <div class="col-12 col-lg-12 form-group--block">
        <div class="form-check">
          <input
            class="form-check-input"
            type="checkbox"
            id="email0"
            value=""
          />
          <label for="email0"
            >I want to receive exclusive offers and promotions from
            <strong>OneStore.</strong></label
          >
        </div>
      </div>
      <div class="col-12 col-lg-6 form-group--block">
        <label>Date Of Birth: <span>*</span></label>
        <input v-model="date_of_birth" :class="errors.date_of_birth?'is-invalid':''" class="form-control" type="date" required="" />
        <div v-if="errors.date_of_birth" class="invalid-feedback">{{errors.date_of_birth[0]}}</div>
      </div>
      <div class="col-12 col-lg-6 form-group--block">
        <label>Gender: <span>*</span></label>
        <select  :class="errors.gender?'is-invalid':''" class="form-control " style="height:45px" v-model="gender" name="gender">
          
          <option selected value="male">Male</option>
          <option value="female">Female</option>
          <option value="gay">Gay</option>
          <option value="other">Other</option>
        </select>
        <div v-if="errors.gender" class="invalid-feedback">{{errors.gender[0]}}</div>
      </div>
    </div>
    <button class="btn btn-login" @click="signUp">Register</button>
    <div class="login__conect">
      <hr />
      <p>Or Sign Up with</p>
      <hr />
    </div>
    <div class="row">
      <div class="col-12 col-lg-6">
        <button class="btn btn-social btn-facebook" type="button">
          <i class="fa fa-facebook-f"></i>Facebook
        </button>
      </div>
      <div class="col-12 col-lg-6">
        <button class="btn btn-social btn-google" type="button">
          <i class="fa fa-google-plus"></i>Google
        </button>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</template>
<script>
export default {
    data(){
        return{
            name:'',
            phone:'',
            email:'',
            password:'',
            confirm_password:'',
            date_of_birth:'',
            gender:'',
            errors:{},
        }
    },
    methods:{
        signUp(){
            axios.post(`/addnew/customer`,{
                name: this.name,
                email: this.email,
                phone: this.phone,
                password: this.password,
                password_confirmation: this.confirm_password,
                date_of_birth: this.date_of_birth,
                gender: this.gender,
            }).then(response=>{
                  this.$toast.success(response.data, 'success', {
                    timeout: 3000,
                    position: "topRight",
                });
                window.location.href = '/'
            }).catch(error=>{
                this.errors=error.response.data.errors;
                  this.$toast.error(error.response.data.message, 'success', {
                    timeout: 3000,
                    position: "topRight",
                });
            });
        }
    }
};
</script>