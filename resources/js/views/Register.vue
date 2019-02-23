<template>
    <div class="row">
            <div class="col-md-12 my-1">
                <div class="card bg-light">
                    <div class="card-header bg-dark text-light text-center"><h5>Register an account</h5></div>
                    <div class="card-body ">
                        <form @submit.prevent="validateInputs()">
                            
                            <div class="form-group">
                            <label for="firstname">Firstname:</label>
                            <input v-validate="'required|min:3|alpha_spaces'" v-model="firstname" type="text" name="firstname" class="form-control" placeholder="Your name" >
                            <span>{{ errors.first('firstname') }}</span>
                            </div>

                            <div class="form-group">
                            <label for="lastname" >Lastname:</label>
                            <input v-validate="'required|min:3|alpha_spaces'" v-model="lastname" type="text" name="lastname" class="form-control" placeholder="Your name" >
                            <span>{{ errors.first('lastname') }}</span>
                            </div>

                            <div class="form-group">
                            <label for="email">Email Address:</label>
                            <input v-validate="'required|email'" v-model="email" type="email" class="form-control" name="email" placeholder="Your email">
                            <span>{{ errors.first('email') }}</span>
                            </div>

                            <div class="form-group">
                            <label for="phone">Phone: </label>
                            <input v-validate="'required|digits:11'" v-model="phone" type="text" name="phone" class="form-control" placeholder="e.g 08012345678">
                            <span>{{ errors.first('phone') }}</span>
                            </div>

                            <div class="form-group">
                            <label for="password">Password:</label>
                            <input v-validate="'required|min:6'" v-model="password" type="password" class="form-control" name="password" ref="password" placeholder="Enter Password">
                            <span>{{ errors.first('password') }}</span>
                            </div>

                            <div class="form-group">
                            <label for="password_confirmation">Confirm Password:</label>
                            <input v-validate="'required|confirmed:password'" v-model="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Re-type Password">
                            <span>{{ errors.first('password_confirmation') }}</span>
                            </div>
                            
                            <div class="form-group text-center">
                                <button :disabled="loading" type="submit" class="btn btn-dark">
                                    <font-awesome-icon v-if="loading" icon="spinner" spin/>
                                    {{loading? '' : 'Register'}}
                                </button>
                            </div>

                        </form>           
                    </div>
                </div>
            </div>
    </div>
</template>

<script>

export default {
    beforeRouteEnter(to, from, next){
        if(localStorage.getItem('auth')){
            return next({path: "/"})
        }
        next();
    },
    data(){
        return{
            firstname: '',
            lastname: '',
            email: '',
            phone: '',
            password: '',
            password_confirmation: '',

            submitted: false,
            loading: false,
        }
    },

    methods: {
        validateInputs(){
             this.$validator.validate().then(result => {
                if (result) {
                    this.registerUser();
                }else{
                    this.$noty.error('Kindly fill the highlighted fields...');
                    return;
                }
            });
        },        

        registerUser(){            
            this.loading = true;
           
            let form_data = {
                "name": this.firstname+' '+this.lastname,
                "email": this.email,
                "phone": this.phone,
                "password": this.password,
                "password_confirmation": this.password_confirmation
            }
            
            this.axios.post('/api/auth/signup',form_data)
            .then((response)=>{
                this.loading = false;
                this.submitted = true;

                if(response.status == 201){
                    this.$noty.success(response.data.message);
                    this.$router.push({name:'login', params:{dataSuccessMsg: response.data.message}});
                }
            })
            .catch((response) =>{
                console.log(response);
                this.loading = false;
                this.$noty.error(response.message);
                this.submitted = true;
                
            });
           
        },
        
    }
 
}
</script>
