<template>
    <div class="row">
            <div class="col-md-12 my-1">
                <div v-if="regSuccessMsg" class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{regSuccessMsg}}</strong>
                </div>
                <div v-if="serverError" class="alert alert-danger" role="alert">
                    <strong>{{serverError}}</strong>
                </div>

                <div class="card bg-light">
                    <div class="card-header bg-dark text-light text-center"><h5>Login</h5></div>
                    <div class="card-body ">
                        <form @submit.prevent="validateInputs()">  
                            
                            <div class="form-group">
                            <label for="">Username:</label>
                            <input v-validate="'required|email'" v-model="username" type="email" class="form-control" name="username"  placeholder="Your email">
                            <span>{{ errors.first('username') }}</span>
                            </div>

                            <div class="form-group">
                            <label for="password">Password:</label>
                            <input v-validate="'required'" v-model="password" type="password" class="form-control" name="password"  placeholder="Enter Password">
                            <span>{{ errors.first('password') }}</span>
                            </div>
                            
                            <div class="form-group text-center">
                                <button :disabled="loading" type="submit" class="btn btn-dark">
                                    <font-awesome-icon v-if="loading" icon="spinner" spin/>                            
                                    {{loading? '' : 'Login'}}
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
            username: '',
            password: '',

            loading: false,
            regSuccessMsg: this.dataSuccessMsg,
            serverError: '',
        }
    },

    props: {
        dataSuccessMsg: {
            type: String,
        }
    },

    methods: {
        validateInputs(){
             this.$validator.validate().then(result => {
                if (result) {
                    this.loginUser();
                }else{
                    this.serverError = 'Kindly fill the highlighted fields...';
                    this.$noty.error(this.serverError);
                    this.regSuccessMsg ='';
                    return;
                }
            });
        },        
        loginUser(){
            this.loading = true;
            this.axios.post('/api/auth/login',{
                username: this.username,
                password: this.password
            })
            .then((response)=>{
                this.loading = false;
                this.$noty.success("Successfully logged in...");

                let token = response.data.access_token;                
                this.makeUserInfo(token);

                this.$router.push('/');               
            })
            .catch((errors)=>{
                this.loading = false;   
                this.password = ''; 
                this.regSuccessMsg = '';
                this.serverError ='Your credentials are incorrect. Please try again';
                this.$noty.error(this.serverError);
            });
        },
        makeUserInfo(token){
            this.axios.defaults.headers.common['Authorization'] = 'Bearer '+token;
            this.axios.get('api/auth/user')
            .then((response)=>{
                let output = {
                    name: response.data.name,
                    email: response.data.email,
                    active: response.data.active,
                    id: response.data.id,
                    token: token
                };
                this.$root.auth = output;
                localStorage.setItem('auth',JSON.stringify(output));
            })
            .catch((error)=>{
                this.serverError = 'Error while trying to log user in... try again';
                this.$noty.error(this.serverError);
                this.regSuccessMsg = '';
            });
        }
    }
 
}
</script>
