<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-danger" role="alert" v-if="errorMessage != ''">{{errorMessage}}</div>
            <div class="alert alert-success" role="alert" v-if="successMessage != ''">{{successMessage}}</div>

            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" v-model="formData.name" class="form-control" required autocomplete="name" autofocus v-on:keyup="hideErrors('name')">
                            <span class="invalid-feedback" role="alert" v-bind:class="{ displayEl: error.name != null }">{{ error.name }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" v-model="formData.email" required autocomplete="email" v-on:keyup="hideErrors('email')">
                            <span class="invalid-feedback" role="alert" v-bind:class="{ displayEl: error.email != null }">{{ error.email }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" v-model="formData.password" required autocomplete="new-password" v-on:keyup="hideErrors('password')">
                            <span class="invalid-feedback" role="alert" v-bind:class="{ displayEl: error.password != null }">{{ error.password }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" v-model="formData.password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">

                            <button type="submit" class="btn btn-primary" @click="submit">Register</button>
                            <router-link :to="{ name: 'login'}" class="nav-link">
                                Go to Login
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import WebServices from '../WebServices';
export default {
    name: "Register",
    data : function (){
        return {
            formData : {
                name : '',
                email : '',
                password : '',
                password_confirmation : ''
            },
            error : {
                name : '',
                email : '',
                password : ''
            },
            errorMessage : '',
            successMessage : ''
        }
    },
    methods : {
        submit(){
            let self = this;
            self.errorMessage = '';
            self.successMessage = '';

            WebServices.storeRegister(self.formData)
                .then(response => {
                    response = response.data;

                    if (response.status == true){
                        self.successMessage = response.message;

                        if (response.hasOwnProperty('redirect')){
                            setTimeout(()=>{
                                self.$router.push('/'+response.redirect);
                            },1000);
                        }

                    }
                })
                .catch(error => {
                    let response = error.response;
                    if (response.status == 422){
                        self.validationErrors(response.data.errors);
                    }else{
                        self.errorMessage = response.data.message;
                    }
                });
        },
        validationErrors(errors){
            this.error.name = errors.hasOwnProperty('name') ? errors.name[0] : '';
            this.error.email = errors.hasOwnProperty('email') ? errors.email[0] : '';
            this.error.password = errors.hasOwnProperty('password') ? errors.password[0] : '';
        },
        hideErrors(type){
            if (this.formData[type] != ''){
                this.error[type] = '';
            }
        }
    },
    beforeMount(){
        WebServices.checkUserLoggedIn().then(response => {
            response = response.data;
            if (response.status == true){
                this.$router.push('/'+response.redirect);
            }
        });
    }
}
</script>

<style scoped>

</style>
