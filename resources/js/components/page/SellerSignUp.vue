<template>
    <section class="section--registration">
    <div class="container">
        <h2 class="page__title">Vendor Registration</h2>
        <p class="page__subtitle">Get started by just filling out one simple form</p>
        <form @submit.prevent="addSeller">
            <div class="registration__content">
                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="registration__info">
                            <h3 class="registration__title">Account Information</h3>
                            <form>
                                <div class="form-row">
                                    <div class="col-12 col-lg-6 form-group--block">
                                        <label>First name: <span>*</span></label>
                                        <input v-model="formFields.first_name" class="form-control" :class="errors.first_name?'is-invalid':''" type="text" required>
                                        <div v-if="errors.first_name" class="invalid-feedback">{{errors.first_name[0]}}</div>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group--block">
                                        <label>Last name<span>*</span></label>
                                        <input class="form-control" v-model="formFields.last_name" :class="errors.last_name?'is-invalid':''" type="text" required>
                                        <div v-if="errors.last_name" class="invalid-feedback">{{errors.last_name[0]}}</div>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group--block">
                                        <label>Phone: <span>*</span></label>
                                        <input v-model="formFields.phone" :class="errors.phone?'is-invalid':''" class="form-control" type="number" required>
                                        <div v-if="errors.phone" class="invalid-feedback">{{errors.phone[0]}}</div>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group--block">
                                        <label>Email: <span>*</span></label>
                                        <input v-model="formFields.email" :class="errors.email?'is-invalid':''" class="form-control" type="email" required>
                                        <div v-if="errors.email" class="invalid-feedback">{{errors.email[0]}}</div>
                                    </div>
                                    
                                    <div class="col-12 col-lg-6 form-group--block">
                                        <label>Citizenship/Passport No: <span>*</span></label>
                                        <input v-model="formFields.citizenship_or_passport_no" :class="errors.citizenship_or_passport_no?'is-invalid':''" class="form-control" type="text" required="required">
                                        <div v-if="errors.citizenship_or_passport_no" class="invalid-feedback">{{errors.citizenship_or_passport_no[0]}}</div>
                                    </div>
                                   
                                
                                    <div class="col-12 col-lg-6 form-group--block">
                                        <label>Zip Code:</label>
                                        <input v-model="formFields.zip_code" :class="errors.zip_code?'is-invalid':''" class="form-control" type="text">
                                        <div v-if="errors.zip_code" class="invalid-feedback">{{errors.zip_code[0]}}</div>
                                    </div>
                                    <div class="col-12 col-lg-12 form-group--block">
                                        <label>Address: <span>*</span></label>
                                        <input v-model="formFields.address" :class="errors.address?'is-invalid':''" class="form-control" type="text" required>
                                        <div v-if="errors.address" class="invalid-feedback">{{errors.address[0]}}</div>
                                    </div>
                                   
                                    <div class="col-12 col-lg-6 form-group--block">
                                        <label>Password: <span>*</span></label>
                                        <input v-model="formFields.password" :class="errors.password?'is-invalid':''" class="form-control" type="password">
                                        <div v-if="errors.password" class="invalid-feedback">{{errors.password[0]}}</div>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group--block">
                                        <label>Retype password: <span>*</span></label>
                                        <input class="form-control"  v-model="formFields.confirm_password" :class="errors.password_confirmation?'is-invalid':''" type="password">
                                         <div v-if="errors.password_confirmation" class="invalid-feedback">{{errors.password_confirmation[0]}}</div>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group--block">
                                        <label>Upload Citizenship Front File:
                                            <span>*</span>
                                        </label>
                                         <div class="imageWrapper">
                                            <img class="image" :src="imagePreviewFront">
                                          </div>
                                          <button class="file-upload">     
                                              <input type="file" @change="citizenFrontChange" class="file-input">Choose File
                                          </button>
                                          <div v-if="errors.citizen_front_photo" style="color:red">{{errors.citizen_front_photo[0]}}</div>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group--block">
                                        <label>Upload Citizenship Back File:
                                            <span>*</span> 
                                        </label>
                                         <div class="imageWrapper">
                                            <img class="image" :src="imagePreviewBack">
                                          </div>
                                          <button class="file-upload">     <input type="file" @change="citizenBackChange" class="file-input">Choose File
                                          </button>
                                          <div v-if="errors.citizen_back_photo" style="color:red">{{errors.citizen_back_photo[0]}}</div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <h3 class="registration__title">Shop Information</h3>
                        <div class="registration__box">
                            <form>
                                <div class="form-row">
                                    <div class="col-12 form-group--block">
                                        <label>Shop Name: <span>*</span></label>
                                        <input class="form-control" v-model="formFields.shop_name" :class="errors.shop_name?'is-invalid':''" type="text" required>
                                        <div v-if="errors.shop_name" class="invalid-feedback">{{errors.shop_name[0]}}</div>
                                    </div>
                                    <div class="col-12 form-group--block">
                                        <label>Shop URL:</label>
                                        <input class="form-control" v-model="formFields.shop_url" :class="errors.shop_url?'is-invalid':''" type="text">
                                        <div class="example">Preview; http://bhandaribikash.com.np/<span style="color:green">{{formFields.shop_url}}</span></div>
                                        <div v-if="errors.shop_url" class="invalid-feedback">{{errors.shop_url[0]}}</div>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group--block">
                                        <label>Country: </label>
                                        <input v-model="formFields.country" :class="errors.country?'is-invalid':''" class="form-control" type="text">
                                        <div v-if="errors.country" class="invalid-feedback">{{errors.country[0]}}</div>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group--block">
                                        <label>City: </label>
                                        <input v-model="formFields.city" :class="errors.city?'is-invalid':''" class="form-control" type="text">
                                        <div v-if="errors.city" class="invalid-feedback">{{errors.city[0]}}</div>
                                    </div>
                                    <div class="col-12 form-group--block">
                                        <label>Shop Address: </label>
                                        <input v-model="formFields.shop_address" :class="errors.shop_address?'is-invalid':''" class="form-control" type="text">
                                        <div v-if="errors.shop_address" class="invalid-feedback">{{errors.shop_address[0]}}</div>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group--block">
                                        <label>Shop Phone Number: </label>
                                        <input  v-model="formFields.shop_phone" :class="errors.shop_phone?'is-invalid':''" class="form-control" type="text">
                                        <div v-if="errors.shop_phone" class="invalid-feedback">{{errors.shop_phone[0]}}</div>
                                    </div>
                                    <div class="col-12 col-lg-6 form-group--block">
                                        <label>Shop PAN/VAT Number: </label>
                                        <input v-model="formFields.shop_pan" :class="errors.shop_pan_or_vat_no?'is-invalid':''" class="form-control" type="number">
                                        <div v-if="errors.shop_pan_or_vat_no" class="invalid-feedback">{{errors.shop_pan_or_vat_no[0]}}</div>
                                    </div>
                                   
                                </div>
                            </form>
                        </div>
                        <p class="privacy_text">By creating an account, you agree to OneStore <span class="text-success"> <a href="#">Conditions of Use </a> </span>and <span class="text-success"> <a href="#"> Privacy Notice. </a></span></p>
                        <button type="submit" class="btn ps-button">Register</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
</template>
<script>
export default {
    data(){
        return{
            imagePreviewFront: 'http://via.placeholder.com/455x315',
            showPreviewFront: false,
            imagePreviewBack: 'http://via.placeholder.com/455x315',
            showPreviewBack: false,
            formFields: {
                first_name :'',
                last_name  :'',
                email      :'',
                city       :'',
                address    :'',
                phone      :'',
                country    :'',
                shop_name  :'',
                shop_url   :'',
                shop_address:'',
                shop_phone:'',
                shop_pan : '',
                citizenship_or_passport_no:'',
                zip_code:'',
                password:'',
                confirm_password:'',
                citizen_front_photo:null,
                citizen_back_photo :null,
            },
            errors:[],
        }
    },
    methods:{
        addSeller(){
            let formData = new FormData();
            formData.append("first_name", this.formFields.first_name);
            formData.append("last_name", this.formFields.last_name);
            formData.append("email", this.formFields.email);
            formData.append("phone", this.formFields.phone);
            formData.append("country", this.formFields.country);
            formData.append("city", this.formFields.city);
            formData.append("zip_code", this.formFields.zip_code);
            formData.append("shop_name", this.formFields.shop_name);
            formData.append("shop_address", this.formFields.shop_address);
            formData.append("address", this.formFields.address);
            formData.append("shop_url", this.formFields.shop_url);
            formData.append("shop_phone", this.formFields.shop_phone);
            formData.append("shop_pan_or_vat_no", this.formFields.shop_pan);
            formData.append("citizenship_or_passport_no", this.formFields.citizenship_or_passport_no);
            formData.append("password", this.formFields.password);
            formData.append("password_confirmation", this.formFields.confirm_password);
            formData.append("citizen_front_photo", this.formFields.citizen_front_photo);
            formData.append("citizen_back_photo", this.formFields.citizen_back_photo);
            axios.post(`/seller/register`,formData).then(response=>{
                console.log(response.data);
            }).catch(error=>{
                console.log(error.response.data.errors)
                this.errors = error.response.data.errors;
                this.$toast.error(error.response.data.message, 'error', {
                    timeout: 3000,
                    position: "topRight",
                });
            });
        },
        citizenFrontChange(event){
            
            this.formFields.citizen_front_photo = event.target.files[0];
            
            
            let reader  = new FileReader();
            reader.addEventListener("load", function () {
                this.showPreviewFront = true;
                this.imagePreviewFront = reader.result;
            }.bind(this), false);
            
            if( this.formFields.citizen_front_photo){
                if ( /\.(jpe?g|png|gif)$/i.test( this.formFields.citizen_front_photo.name ) ) {
                    reader.readAsDataURL( this.formFields.citizen_front_photo);
                }
            }
        },
        citizenBackChange(event){
            
            this.formFields.citizen_back_photo = event.target.files[0];
            let reader  = new FileReader();
            reader.addEventListener("load", function () {
                this.showPreviewBack = true;
                this.imagePreviewBack = reader.result;
            }.bind(this), false);
            
            if( this.formFields.citizen_back_photo){
                if ( /\.(jpe?g|png|gif)$/i.test( this.formFields.citizen_back_photo.name ) ) {
                    reader.readAsDataURL( this.formFields.citizen_back_photo);
                }
            }
        }
    },
    

}
</script>