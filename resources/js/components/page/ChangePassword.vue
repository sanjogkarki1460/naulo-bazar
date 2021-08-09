<template>
  <div class="form-row">
    <div class="col-12 col-lg-12 form-group--block">
      <label>Current Password: <span>*</span></label>
      <input
        class="form-control"
        name="old_password"
        v-model="old_password"
        type="password"
        autocomplete="off"
        placeholder="Please Enter Your Current Password"
      />
      <small v-if="errors.old_password" style="color:red">{{errors.old_password[0]}}</small>
    </div>
    <div class="col-12 col-lg-6 form-group--block">
      <label>New Password: <span>*</span></label>
      <input
        class="form-control"
        v-model="password"
        name="password"
        type="password"
        placeholder="Minimum 6 characters with a number and a letter"
      />
      <small v-if="errors.password" style="color:red">{{errors.password[0]}}</small>
    </div>
    <div class="col-12 col-lg-6 form-group--block">
      <label>Retype Password: <span>*</span></label>
      <input
        class="form-control"
        v-model="confirm_password"
        name="password_confirmation"
        type="password"
        placeholder="Please retype your password"
      />
      <small v-if="errors.password_confirmation" style="color:red">{{errors.password_confirmation[0]}}</small>
    </div>
    <div class="col-12 col-lg-12 form-group--block">
      <button class="btn btn-save" @click="updatePassword" type="submit">Save Changes</button>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      old_password: "",
      password: "",
      confirm_password: "",
      errors:{},
    };
  },
  methods:{
      updatePassword() {
      
        axios
          .post(`/change/password`, {
            old_password: this.old_password,
            password: this.password,
            password_confirmation: this.confirm_password,
          })
          .then((response) => {
            this.errors=[];
            if(response.data.error){
                this.$toast.error(response.data.error, 'Error', {
                    timeout: 5000,
                    position: "topRight",
                });
                return;
            }
               this.$toast.success('New password updated succefully', 'Success', {
                    timeout: 5000,
                    position: "topRight",
                });
                window.location.href = '/'
          })
          .catch((error) => {
            this.errors = error.response.data.errors;
          });
      
    },
  },
  computed: {
    passwordConfirmationRule() {
      return () =>
        this.password === this.confirm_password || "Password must match";
    },
  },
};
</script>